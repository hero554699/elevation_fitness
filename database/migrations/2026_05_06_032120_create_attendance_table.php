<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Runs when you do: php artisan migrate
    // Must run AFTER members and branches migrations
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id('attendance_id');

            // Foreign key to members table
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('member_id')->on('members');

            // Foreign key to branches table
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('branch_id')->on('branches');

            $table->date('check_in_date');
            $table->time('check_in_time');

            // Trigger 2 fires after every insert on this table
            // and auto-updates members.last_checkin

            $table->timestamps();
        });
    }

    // Runs when you do: php artisan migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};