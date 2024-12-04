<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quick_bookings', function (Blueprint $table) {
            $table->bigIncrements('QuickBooking_id');
            $table->string('image')->nullable();
            $table->string('short_title')->nullable();
            $table->string('main_title')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_bookings');
    }
};
