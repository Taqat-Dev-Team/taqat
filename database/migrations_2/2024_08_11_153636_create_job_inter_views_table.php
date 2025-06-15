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
        Schema::create('job_inter_views', function (Blueprint $table) {
            $table->id();
            $table->string('zoom_url');
            $table->time('time');
            $table->date('date');
            $table->bigInteger('user_id');
            $table->bigInteger('company_id');
            $table->bigInteger('job_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_inter_views');
    }
};
