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
        Schema::create('subsciptions', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            $table->string('status');
            $table->string('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('laundry_id');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsciptions');
    }
};
