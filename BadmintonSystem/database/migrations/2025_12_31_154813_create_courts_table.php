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
    Schema::create('courts', function (Blueprint $table) {
        $table->id('court_id'); // Matches your Model's primaryKey
        $table->string('court_name');
        $table->string('court_type');
        $table->string('location');
        $table->string('status')->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
