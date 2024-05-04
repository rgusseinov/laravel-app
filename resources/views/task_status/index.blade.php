@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-5">
        <h1>Статусы</h1>
        <br />
        
        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя</th>
            <th scope="col">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{$status->id}}</td>
                    <td>{{$status->name}}</td>
                    <td>{{$status->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection
