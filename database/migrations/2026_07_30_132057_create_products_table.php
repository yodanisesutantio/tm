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
        Schema::create('M90CAF9', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('category')->nullable();
            $table->string('code', 64)->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('stock', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('M90CAF9');
    }
};
