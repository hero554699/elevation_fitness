<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Runs when you do: php artisan migrate
    // Must run AFTER members and membership_plans migrations
    public function up(): void
    {
        Schema::create('renewal_log', function (Blueprint $table) {
            $table->id('renewal_id');

            // Foreign key to members table
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('member_id')->on('members');

            // Old plan before renewal — nullable in case it was not set
            $table->unsignedBigInteger('old_plan_id')->nullable();

            // New plan after renewal
            $table->unsignedBigInteger('new_plan_id');
            $table->foreign('new_plan_id')->references('plan_id')->on('membership_plans');

            $table->date('old_expiry')->nullable();
            $table->date('new_expiry');

            // renewed_at is handled by timestamps below
            $table->timestamps();
        });
    }

    // Runs when you do: php artisan migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('renewal_log');
    }
};