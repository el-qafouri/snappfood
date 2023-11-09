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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price' , '10' , '2');
            $table->decimal('final_price');
            $table->string('material');
            $table->foreignId('food_category_id')->nullable();
            $table->foreign('food_category_id')->references('id')
                ->on('food_categories')->cascadeOnDelete();
//            $table->unsignedBigInteger('restaurant_id')->nullable();
//            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
