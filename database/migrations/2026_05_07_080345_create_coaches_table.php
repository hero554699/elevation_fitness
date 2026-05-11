<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id('coach_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique()->nullable();
            $table->string('phone', 20)->nullable();

            $table->enum('specialty', [
                'Personal Training',
                'Strength & Conditioning',
                'Cardio & Endurance',
                'Indoor Cycling',
                'Zumba Instructor',
                'Yoga & Flexibility',
                'Boxing & Martial Arts',
                'Nutrition & Diet Coaching',
                'Group Fitness Instructor',
                'Rehabilitation & Recovery',
            ]);

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('branch_id')->on('branches');

            $table->text('bio')->nullable();
            
            
            $table->string('certification_path')->nullable();

            $table->date('date_hired')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};