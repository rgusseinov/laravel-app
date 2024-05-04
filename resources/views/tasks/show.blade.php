@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                <div class="grid col-span-full">
                    <h2 class="mb-5">Просмотр задачи: {{ $task->name }}<a href={{ url("/tasks/{$task->id}/edit") }}>⚙</a></h2>
                    <p><span class="font-black">Имя:</span> {{ $task->name }}</p>
                    <p><span class="font-black">Статус:</span> {{ $task->status_name }}</p>
                    <p><span class="font-black">Описание:</span> {{ $task->description }} </p>
                    <p><span class="font-black">Метки:</span></p>
                    <div>                
                        @foreach($labelsData as $label)
                            {{ $label->label_name }},
                        @endforeach                    
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
