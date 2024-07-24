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
        Schema::create('user_forms', function (Blueprint $table) {
            $table->uuid('guid')->primary();
            $table->char('form_guid', 40);
            $table->char('user_guid', 50);
            $table->string('status');
            $table->foreign('user_guid')->references('guid')->on('users')->onDelete('cascade');
            $table->foreign('form_guid')->references('guid')->on('forms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_forms');
    }
};
