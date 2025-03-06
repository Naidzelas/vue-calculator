<?php

use App\Models\User;

it('returns a successful home response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('returns a successful calculator response', function () {
    $this->actingAs($user = User::factory()->create());
    $response = $this->get('/calculator');

    $response->assertStatus(200);
});