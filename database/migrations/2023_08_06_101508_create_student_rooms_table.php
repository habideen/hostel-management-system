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
        Schema::create('student_rooms', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->unsignedInteger('department_id'); //some students change departments
            $table->unsignedBigInteger('block_id');
            $table->unsignedSmallInteger('room_no');
            $table->unsignedSmallInteger('bed_space');
            $table->unsignedBigInteger('session_id');
            $table->string('hostel_card', 20);
            $table->string('expelled', 1);
            $table->string('expelled_reason', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_rooms');
    }
};
