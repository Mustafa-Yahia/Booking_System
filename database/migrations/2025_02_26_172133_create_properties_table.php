<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user_id is the lessor
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('price_per_day', 10, 2);
            $table->enum('status', ['available', 'rented'])->default('available');
            $table->enum('type',['Villa', 'Apartment', 'House' , 'studio', 'other'])->default('Apartment');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
