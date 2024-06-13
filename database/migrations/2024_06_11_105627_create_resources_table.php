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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->boolean('is_group')->default(false);
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('expiration_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('resources', function (Blueprint $table) {
           $table->index('group_id');

           $table->foreign('group_id')->references('id')->on('resources')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
