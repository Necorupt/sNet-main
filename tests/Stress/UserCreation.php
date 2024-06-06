<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
abstract class TestCase extends BaseTestCase
{

}

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
