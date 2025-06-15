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
        Schema::create('company_projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->string('title');
            $table->longText('description');
            $table->string('expected_budget');
            
            $table->text('similar_example')->nullable();
            $table->text('skills')->nullable();
            $table->text('received_required')->nullable();
            $table->integer('status')->default(1);
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('offer_id')->nullable();
            $table->double('rate')->nullable();
            // $table->double('')
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_projects');
    }
};
