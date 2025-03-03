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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المستأجر الذي كتب التقييم
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade'); // العقار الذي تم تقييمه
            $table->tinyInteger('rating')->unsigned(); // التقييم من 1 إلى 5
            $table->text('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}
};
