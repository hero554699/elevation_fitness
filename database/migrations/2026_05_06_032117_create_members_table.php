<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id'); // This creates AUTO_INCREMENT primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('plan_id');
            $table->enum('status', ['pending', 'active', 'expired'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->string('reference_no')->unique();
            $table->date('membership_start')->nullable();
            $table->date('membership_end')->nullable();
            $table->dateTime('last_checkin')->nullable(); // CHANGED: date to dateTime
            $table->timestamps();

            // Foreign keys
            $table->foreign('branch_id')
                ->references('branch_id')
                ->on('branches')
                ->onDelete('cascade');

            $table->foreign('plan_id')
                ->references('plan_id')
                ->on('membership_plans')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
