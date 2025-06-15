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
        Schema::create('customer_points', function (Blueprint $table) {
            $table->id();
            $table->boolean('use_points_system')->default(true);
            $table->boolean('show_earned_points')->default(true);
            $table->boolean('cumulative_points')->default(true);
            $table->integer('registration_points')->default(15);
            $table->integer('points_to_currency')->default(1); // 1 point = X currency
            $table->integer('currency_to_points')->default(1); // X currency = 1 point
            $table->integer('points_expiry_days')->default(360);
            $table->boolean('require_password_for_redeem')->default(true);
            $table->integer('minimum_points_to_redeem')->default(7);
            $table->boolean('exclude_discounted_invoices')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_points');
    }
};
