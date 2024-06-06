@extends('layouts.laravel')

@section('content')
    <div class="container">
        <h1>Параметры пользователя</h1>

        <form action="/user/update" method="POST" enctype="multipart/form-data">

            @csrf
            <input type="text" value="{{$user['name']}}" name="name" placeholder="name">
            <input type="text" value="{{$user['lastname']}}" name="lastname" placeholder="lastname">
            <input type="file" name="avatar_image">

            <button type="submit">send</button>
        <form>
    </div>
@endsection
