@extends('layouts.laravel')

@section('content')
    <div class="container">
        <h1>Посты</h1>

        <div class="user--list">
            @foreach ($posts as $post)
                <div class="user--list__el" style="border:1px solid black; padding:10px;display:flex;flex-direction:row; gap: 20px;">
                    <div class="user--list__el--header" style="display: flex;flex-direction:row;gap:20px;">
                        <h1>{{ $post['title'] }}</h1>
                        <h1>{{ $post['text'] }}</h1>
                    </div>
                    <h2> @id{{$post['id']}}<h2>
                    <h2>user id: @id{{$post['user_id']}}<h2>
                    <h2>creation date{{$post['created_at']}}<h2>
                </div>
            @endforeach
        </div>
    </div>
@endsection
