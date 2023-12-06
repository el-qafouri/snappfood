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
//            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
//            $table->enum('payment_status', ['canceled', 'paid', 'unpaid']);
            $table->enum('seller_status', ['pending', 'preparing', 'send', 'delivered'])->default('pending');
            $table->decimal('total_price', '10', '2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
