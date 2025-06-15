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
        Schema::create('user_desk_mangments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('desk_mangment_id');
            $table->bigInteger('subscription_type_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_desk_mangments');
    }
};
