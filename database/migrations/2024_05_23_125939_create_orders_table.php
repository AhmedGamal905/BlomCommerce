<?php

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->double('total')->default(0.00);
            $table->string('payment_gateway')->default('cash');
            $table->string('status')->default(OrderStatus::PROCESSING);
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
