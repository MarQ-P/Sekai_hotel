<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;


app(Schedule::class)->command('bookings:update-status')->everyMinute();
app(Schedule::class)->command('bookings:update-status')->dailyAt('14:00:00');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
