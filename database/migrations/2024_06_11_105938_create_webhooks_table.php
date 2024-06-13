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
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->string('request_url')->nullable();
            $table->string('request_method')->default('post');
            $table->string('token')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
