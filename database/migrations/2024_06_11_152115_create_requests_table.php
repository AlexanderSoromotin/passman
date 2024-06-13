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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('senior_specialist_id')->nullable();
            $table->unsignedBigInteger('head_specialist_id')->nullable();
            $table->string('status')->default('created');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('set null');
            $table->foreign('senior_specialist_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('head_specialist_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
