<?php

test('homepage loads', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
