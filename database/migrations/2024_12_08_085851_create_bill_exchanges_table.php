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
        Schema::create('bill_exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number');
            $table->string('id_number');
            $table->string('name');
            $table->string('mobile');
            $table->string('date');
            $table->double('amount');
            $table->string('amount_letter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_exchanges');
    }
};
