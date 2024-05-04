@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <h1>Метки</h1>
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
                @foreach($labels as $label)
                    <tr>
                        <td>{{$label->id}}</td>
                        <td>{{$label->name}}</td>
                        <td>{{$label->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

@endsection
