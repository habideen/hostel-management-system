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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('matric_no', 12)->nullable();
            $table->string('last_name', 30);
            $table->string('first_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('gender', 6);
            $table->string('phone_1')->unique()->nullable();
            $table->string('phone_2')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('account_type', 10);
            $table->unsignedBigInteger('hall_id')->nullable();
            $table->string('disabled', 1)->nullable();
            $table->rememberToken();
            $table->uuid('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
