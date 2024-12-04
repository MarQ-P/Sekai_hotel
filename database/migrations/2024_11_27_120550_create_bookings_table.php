<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('rooms_id')->nullable();;
            $table->string('user_id')->nullable();;
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('person')->nullable();
            $table->string('number_of_room')->nullable();

            $table->float('total_nights')->default(0);
            $table->float('actual_price')->default(0);
            $table->float('subtotal')->default(0);
            $table->integer('discount')->default(0);
            $table->float('total_price')->default(0);

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('Region')->nullable();
            $table->string('Province')->nullable();
            $table->string('Zip')->nullable();
            $table->string('City_Municipality')->nullable();
            $table->string('Baranggay')->nullable();

            $table->string('code')->nullable();
            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
