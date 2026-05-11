<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id('worker_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique()->nullable();
            $table->string('phone', 20)->nullable();

            $table->enum('position', [
                'Branch Manager',
                'Assistant Manager',
                'Front Desk Officer',
                'Membership Consultant',
                'Security Officer (CCTV)',
                'Security Guard',
                'Maintenance Staff',
                'Janitor / Utility Staff',
                'Cashier',
            ]);

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('branch_id')->on('branches');

            $table->string('certification_path')->nullable();
            $table->date('date_hired')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
