<?php

use App\Models\Post;
use App\Models\User;

test('post model create', function () {
    $post = Post::create([
        'title' => 'test text',
        'text' => 'text test',
        'user_id' => '1',
    ]);

    expect($post->title)->toBe('test text');
    expect($post->text)->toBe('text test');
    expect($post->user_id)->toBe('1');
});

test('create user and posts', function () {

    $users = User::all();

    for ($i = 0; $i < 10; $i++) {
        $postTitle = "Post n {$i}";
        $postText = "Post text n {$i}";
        $post = Post::create([
            'title' => $postTitle,
            'text' => $postText,
            'user_id' => 2,
        ]);

        expect($post->title)->toBe($postTitle);
        expect($post->text)->toBe($postText);
        expect($post->user_id)->toBe(2);
    }

});
