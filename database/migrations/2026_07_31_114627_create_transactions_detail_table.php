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
        Schema::create('MA56F63', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('no_inv')->nullable();
            $table->string('inv_date')->nullable();
            $table->string('cust_uuid')->nullable();
            $table->string('cust_code')->nullable();
            $table->string('cust_name')->nullable();
            $table->string('cust_address')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MA56F63');
    }
};
