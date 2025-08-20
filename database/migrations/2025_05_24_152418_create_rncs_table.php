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
        Schema::create('rncs', function (Blueprint $table) {
            $table->id();
            $table->string('rnc')->unique();
            $table->string('business_name');
            $table->text('economic_activity')->nullable();
            $table->date('start_date')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_regime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rncs');
    }
};
