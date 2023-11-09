<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->string('phone');
            $table->string('credit_card_number');
            $table->string('address');
            $table->boolean('profile_status')->default(false);
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('restaurant_category_id')->nullable();
            $table->foreign('restaurant_category_id')->references('id')->on('restaurant_categories')->cascadeOnDelete();
//            $table->foreignId('restaurant_category_id')->constrained();

//            $table->unsignedBigInteger('latitude');
//            $table->unsignedBigInteger('longitude');
            $table->decimal('send_cost')->default('15000');
            $table->time('open_time')->default('09:00:00')->nullable();
            $table->time('close_time')->default('21:00:00')->nullable();
            $table->timestamps();
        });
    }








    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
