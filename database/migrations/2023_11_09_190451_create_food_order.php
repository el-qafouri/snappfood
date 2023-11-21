<?php

use App\Models\Order;
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
        Schema::create('food_order', function (Blueprint $table) {
            $table->id();
            $table->integer('count');

            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('food_id');
            $table->timestamps();
//            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
//            $table->foreignIdFor(Food::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_order');
    }
};
