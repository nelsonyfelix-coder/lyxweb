<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('portfolio:make-admin {email?}', function (?string $email = null) {
    $name = $this->ask('Administrator name');
    $email ??= $this->ask('Administrator email');
    $password = $this->secret('Administrator password (at least 12 characters)');

    if (strlen((string) $password) < 12) {
        $this->error('Use a password with at least 12 characters.');

        return 1;
    }

    User::query()->updateOrCreate(
        ['email' => $email],
        ['name' => $name, 'password' => $password, 'is_admin' => true],
    );

    $this->info("Administrator account ready for {$email}.");

    return 0;
})->purpose('Create or update a portfolio administrator account');
