@extends('layouts.app')

@section('content')
    
    <div class="container">
        <!-- Filters Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Задачи</h1>
            </div>
        </div>

        <!-- Filters Section -->
        {{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
        <div class="row mt-3">
            <div class="col-md-3">
                {{ Form::select('status_id', $statuses, $selectedStatusId, ['class' => 'form-control', 'placeholder' => 'Статус']) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('executor_id', $users, $selectedExecutorId, ['class' => 'form-control', 'placeholder' => 'Исполнитель']) }}
            </div>
            <div class="col-md-3">
                {{ Form::submit('Применить', ['class' => 'btn btn-primary']) }}
            </div>
            <div class="col-md-3">
            @auth
                <a href={{url("/tasks/create")}} class="btn btn-primary">Добавить задачу</a>
            @endauth                
            </div>
        </div>
        {{ Form::close() }}


        <table class="table table mt-3">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Статус</th>
                <th scope="col">Имя</th>
                <th scope="col">Автор</th>
                <th scope="col">Исполнитель</th>
                <th scope="col">Дата создания</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->status_name}}</td>
                        <td><a href={{ url("/tasks/{$task->id}") }}>{{$task->name}}</a></td>
                        <td>{{$task->author_name}}</td>
                        <td>{{$task->executor_name}}</td>
                        <td>{{$task->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-8">
                <p>Showing {{ $tasks->currentPage() }} to {{ $tasks->count() }} of {{ $tasks->count() }} results</p>
            </div> 
            <div class="col-md-3">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

@endsection
