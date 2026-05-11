<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Runs when you do: php artisan migrate
    // Must run AFTER branches and membership_plans migrations
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();

            // Foreign key to branches table
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('branch_id')->on('branches');

            // Foreign key to membership_plans table
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('plan_id')->on('membership_plans');

            $table->date('membership_start')->nullable();
            $table->date('membership_end')->nullable();

            // Member status — active, expired, pending
            // Auto-updated by Trigger 1 when payment is inserted
            $table->enum('status', ['active', 'expired', 'pending'])->default('pending');

            // Payment status — admin marks this paid after member pays at branch
            // unpaid = submitted form but not yet paid at branch
            // paid   = confirmed paid at branch by admin
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            // Reference number shown to member after public signup
            // They bring this to the branch to identify their registration
            $table->string('reference_no', 50)->nullable()->unique();

            // last_checkin is auto-updated by Trigger 2 when attendance is inserted
            $table->date('last_checkin')->nullable();

            $table->timestamps();
        });
    }

    // Runs when you do: php artisan migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};