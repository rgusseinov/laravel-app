@extends('layouts.app')

@section('content')

<div class="container">
        <h2 class="mb-5">Редактирование задачи: {{ $task->name }}</h2>

        {{ Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'PATCH']) }}
        <!-- Post Form -->
        <div class="row">
            <div class="col-md-6">
                <!-- Field: Name -->
                <div class="form-group">
                    {{ Form::label('name', 'Имя', ['class' => 'form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <!-- Field: Description -->
                <div class="form-group">
                    {{ Form::label('description', 'Описание') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                </div>

                <!-- Field: Status -->
                <div class="form-group">
                    {{ Form::label('status_id', 'Статус', ['class' => 'form-label']) }}
                    {{ Form::select('status_id', $statuses, null, ['class' => 'form-control', 'placeholder' => 'Select Option']) }}
                </div>
                @error('status_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <!-- Field: Executor -->
                <div class="form-group">
                    {{ Form::label('executor_id', 'Исполнитель', ['class' => 'form-label']) }}
                    {{ Form::select('executor_id', $users, null, ['class' => 'form-control']) }}
                </div>

                <!-- Field: Labels -->
                <div class="form-group">
                    {{ Form::label('labels', 'Метки', ['class' => 'form-label']) }}
                    {{ Form::select('labels[]', $labels, null, ['class' => 'form-control', 'multiple' => true]) }}
                </div>

                <br />
                <div class="form-group">
                    {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
