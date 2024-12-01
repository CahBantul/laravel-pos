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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('phone', 20)->nullable(false);
            $table->string('address', 200)->nullable(true);
            $table->unsignedTinyInteger('province_id');
            $table->unsignedSmallInteger('regency_id');
            $table->unsignedMediumInteger('district_id');
            $table->unsignedBigInteger('village_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
