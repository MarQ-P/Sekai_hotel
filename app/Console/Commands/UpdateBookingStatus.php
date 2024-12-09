<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update pending bookings to completed after the checkout time.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get current time
        $now = Carbon::now();

        // Update bookings
        $updatedBookings = Booking::where('check_out', '<=', $now->format('Y-m-d'))
            ->where('status', 0)
            ->where(function ($query) use ($now) {
                $query->whereRaw('STR_TO_DATE(check_out, "%Y-%m-%d") < ?', [$now->format('Y-m-d')])
                     ->orWhere(function ($subQuery) use ($now) {
                         $subQuery->whereRaw('STR_TO_DATE(check_out, "%Y-%m-%d") = ?', [$now->format('Y-m-d')])
                                  ->whereRaw('TIME(NOW()) >= "14:00:00"');
                     });
            })
            ->update([
                'status' => 1,
                'updated_at' => $now
            ]);

        $this->info("Updated {$updatedBookings} bookings to completed.");
        return Command::SUCCESS;
    }
}
