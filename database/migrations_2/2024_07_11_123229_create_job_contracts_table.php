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
        Schema::create('job_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->date('date');
            $table->bigInteger('user_id');
            $table->string('sallary');
            $table->string('photo');
            $table->string('duration');
            $table->string('job_type');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_contracts');
    }
};
