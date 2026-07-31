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
        Schema::create('MA56F64', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('detail_uuid')->nullable();
            $table->uuid('detail_no_inv')->nullable();
            $table->uuid('product_uuid')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('price', 15, 2)->default(0);
            $table->json('discounts_json')->nullable();
            $table->decimal('net_price', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MA56F64');
    }
};
