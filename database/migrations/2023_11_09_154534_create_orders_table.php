<?php

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Restaurant::class)->constrained()->cascadeOnDelete();
            $table->enum('customer_status', ['canceled', 'paid', 'unpaid'])->default('unpaid');
            $table->enum('seller_status', ['pending', 'preparing', 'send', 'delivered'])->default('pending');
            $table->decimal('total_price', '10', '2');
            $table->timestamps();
        });


//        $table->unsignedBigInteger('user_id');
//        $table->foreign('user_id')->references('id')
//            ->on('users')->onDelete('cascade');
//
//        $table->unsignedBigInteger('restaurant_id');
//        $table->foreign('restaurant_id')->references('id')
//            ->on('restaurants')->onDelete('cascade');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
