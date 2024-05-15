<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    const SHOW_TASKS_PER_PAGE = 7;

    public function index(Request $request)
    {
        $selectedStatusId = null;
        $selectedExecutorId = null;

        $tasksQuery = DB::table("tasks")
                    ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                    ->join('users as authors', 'tasks.author_id', '=', 'authors.id')
                    ->join('users as executors', 'tasks.executor_id', '=', 'executors.id')
                    ->select('tasks.*', 'task_statuses.name as status_name', 'authors.name as author_name', 'executors.name as executor_name');
    
        if ($request->get('status_id')) {
            $tasksQuery->where('tasks.status_id', $request->status_id);
            $selectedStatusId = $request->status_id;
        }
        
        if ($request->get('executor_id')) {
            $tasksQuery->where('tasks.executor_id', $request->executor_id);
            $selectedExecutorId = $request->executor_id;
        }

        $tasks = $tasksQuery->simplePaginate(self::SHOW_TASKS_PER_PAGE)->appends([
            'status_id' => $selectedStatusId,
            'executor_id' => $selectedExecutorId
        ]);

        $users = User::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'users', 'statuses'))
                ->with('selectedStatusId', $selectedStatusId)
                ->with('selectedExecutorId', $selectedExecutorId);
    }

    public function show($id){
        $task = DB::table("tasks")
                    ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                    ->join('users as authors', 'tasks.author_id', '=', 'authors.id')
                    ->join('users as executors', 'tasks.executor_id', '=', 'executors.id')
                    ->select('tasks.*', 'task_statuses.name as status_name', 'authors.name as author_name', 'executors.name as executor_name')
                    ->where('tasks.id', $id)
                    ->first();

        if (!$task){
            abort(404);
        }

        $labels = DB::table('task_labels')
                    ->join('labels', 'task_labels.label_id', '=', 'labels.id')
                    ->select('labels.name as label_name')
                    ->where('task_labels.task_id', $id)
                    ->get();
        $labelsData = $labels; 
        return view('tasks.show', compact('task', 'labelsData'));
    }

    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('tasks.create', compact('task', 'users', 'statuses', 'labels'));
    }


    public function store(Request $request){
        $data = $this->validate($request, [
            'name' => 'required|min:5',
            'status_id' => 'required',
        ],
        [
            'name.required' => 'Это обязательное поле.',
            'name.min' => 'Название задачи должно состоять минимум из 5 символов',
            'status_id.required' => 'Это поле обязательно для заполнения',
        ]);

        $task = new Task();

        $data['status_id'] = $request->status_id;
        $data['author_id'] = auth()->id() ?? 1;
        $data['executor_id'] = $request->executor_id ?? 1;
        $data['description'] = $request->description;

        $task->fill($data);
        $task->save();

        $selectedLabels = $request->input('labels', []);
        foreach ($selectedLabels as $labelId) {
            DB::table('task_labels')->insert([
                'task_id' => $task->id,
                'label_id' => $labelId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        };

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:5',
            'status_id' => 'required',
        ],
        [
            'name.required' => 'Это обязательное поле.',
            'name.min' => 'Название задачи должно состоять минимум из 5 символов',
            'status_id.required' => 'Это поле обязательно для заполнения',
        ]);

        $task = Task::findOrFail($id);
        $currentUserId = 1;

        $data['status_id'] = $request->status_id;
        $data['author_id'] = $currentUserId;
        $data['executor_id'] = $request->executor_id;
        $data['description'] = $request->description;

        $task->fill($data);
        $task->save();

        self::updateLabels($request, $task);

        return redirect()
            ->route('tasks.index');
    }

    public function edit($id){
        $task = DB::table("tasks")
                    ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                    ->join('users as authors', 'tasks.author_id', '=', 'authors.id')
                    ->join('users as executors', 'tasks.executor_id', '=', 'executors.id')
                    ->select('tasks.*', 'task_statuses.name as status_name', 'authors.name as author_name', 'executors.name as executor_name')
                    ->where('tasks.id', $id)
                    ->first();
        if (!$task){
            abort(404);
        }

        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        
        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function statuses()
    {
        $statuses = TaskStatus::all();
        return view('task_status.index', compact('statuses'));
    }

    public function labels()
    {
        $labels = Label::all();
        return view('task_label.index', compact('labels'));
    }

    public static function updateLabels($request, $task)
    {
        $selectedLabels = $request->input('labels', []);
        foreach ($selectedLabels as $labelId) {
            DB::table('task_labels')->insert([
                'task_id' => $task->id,
                'label_id' => $labelId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        };
    }

    public function sum($a, $b)
    {
        return $a + $b;
    }
}
