@extends('layouts.laravel')

@section('content')
    <div class="container">
        <h1>Пользователи</h1>

        <div class="user--list">
            @foreach ($users as $user)
                <div class="user--list__el" style="border:1px solid black; padding:10px;display:flex;flex-direction:row; gap: 20px;">
                    <div class="user--list__el--header" style="display: flex;flex-direction:row;gap:20px;">
                        <h1>{{ $user['name'] }}</h1>
                        <h1>{{ $user['lastname'] }}</h1>
                    </div>
                    <h2> @id{{$user['id']}}<h2>
                </div>
            @endforeach
        </div>
    </div>
@endsection
