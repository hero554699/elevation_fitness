<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Runs when you do: php artisan migrate
    // Must run AFTER members migration
    // This table is auto-populated by Trigger 1
    // You never insert into this table manually
    public function up(): void
    {
        Schema::create('member_audit', function (Blueprint $table) {
            $table->id('audit_id');

            // Foreign key to members table
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('member_id')->on('members');

            // What action was performed e.g. "Payment recorded: registration"
            $table->string('action', 100);

            // Status before the change
            $table->string('old_status', 20)->nullable();

            // Status after the change — always active when trigger fires
            $table->string('new_status', 20)->nullable();

            // The receipt number that caused the trigger to fire
            $table->string('reference', 50)->nullable();

            // action_time handled by timestamps below
            $table->timestamps();
        });
    }

    // Runs when you do: php artisan migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('member_audit');
    }
};