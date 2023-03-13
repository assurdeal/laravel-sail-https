<?php

use function Pest\Laravel\get;

it('can validate correct domain and return proper response', function () {
    get('/sail-https/ssl-check?domain=example.test')
        ->assertOk()
        ->assertSee('Domain Authorized');
});

it('can invalidate incorrect domain and return proper response', function () {
    get('/sail-https/ssl-check?domain=foo.test')
        ->assertStatus(503);
});
