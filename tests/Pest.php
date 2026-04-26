<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature', '../Modules/*/Tests/Feature');

beforeEach(function () {
    $this->withoutMiddleware([
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Spatie\Permission\Middleware\RoleMiddleware::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ]);

    config()->set('logging.default', 'null');

    $privateKey = storage_path('oauth-private.key');
    $publicKey = storage_path('oauth-public.key');

    if (is_readable($privateKey)) {
        config()->set('passport.private_key', file_get_contents($privateKey));
    }

    if (is_readable($publicKey)) {
        config()->set('passport.public_key', file_get_contents($publicKey));
    }
});

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. With these methods, you can write assertions in a more intuitive way.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});
