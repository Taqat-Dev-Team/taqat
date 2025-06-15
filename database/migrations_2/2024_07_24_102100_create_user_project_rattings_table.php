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
        Schema::create('user_project_rattings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->bigInteger('user_id');
            $table->integer('professional_dealing');
            $table->integer('communication_assistance');
            $table->integer('quality_delivered_work');
            $table->integer('experience_in_project_field');
            $table->integer('delivery_on_time');
            $table->integer('deal_with_again');
            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_rattings');
    }
};
