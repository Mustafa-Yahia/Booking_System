<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // user_id is the renter
        $table->foreignId('property_id')->constrained('properties')->onDelete('cascade'); // property_id is the property being booked
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->decimal('total',10,2);
        $table->decimal('fee',10,2)->default(0);
        $table->softDeletes();
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
