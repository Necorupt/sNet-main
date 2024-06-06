@extends('layouts.laravel')

@section('content')

<div class="content">

    <h1>Создать пост</h1>
    <form action="/posts/create" method="POST" class="create--post">

        @csrf
        <input placeholder="загаловок" name="title"></input>
        <input placeholder="текст" name="text"></input>
        
        <button type="submit">Add post</button>
    </form>

    <h1>Add friend</h1>

    <form action="/users/addFriend" method="POST">
        <input placeholder="user id" name="userID0">
        <button type="submit">Add friend</button>
    </form>

    <div class="friend--list">
        
    </div>

    <test-component>
        WHAT
    </test-component>
</div>

@endsection
