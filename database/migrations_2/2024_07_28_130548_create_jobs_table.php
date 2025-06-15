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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('company_id');
            $table->text('description');
            $table->text('job_requirements');
            $table->bigInteger('specialization_id');
            $table->bigInteger('user_id')->nullable();
            $table->double('sallary')->nullable();
            $table->string('permanent_type');
            $table->string('duration');
            $table->text('skills')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
