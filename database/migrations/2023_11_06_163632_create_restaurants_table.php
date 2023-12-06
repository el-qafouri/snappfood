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
            $table->string('address')->nullable();
            $table->boolean('profile_status')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->decimal('send_cost')->default('15000');
            $table->time('open_time')->default('09:00:00')->nullable();
            $table->time('close_time')->default('21:00:00')->nullable();
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });

//        Schema::table('restaurants', function (Blueprint $table) {
//            $table->index('id');
//        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
