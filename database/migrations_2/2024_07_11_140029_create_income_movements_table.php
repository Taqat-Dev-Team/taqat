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
        Schema::create('income_movements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('amount');
            $table->string('source');
            $table->string('photo');
            $table->date('date');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_movements');
    }
};
