<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the old enrollments table and recreate with proper structure
        Schema::dropIfExists('enrollments');

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pendiente', 'activo', 'completado', 'suspendido'])->default('pendiente');
            $table->decimal('progress', 5, 2)->default(0);
            $table->dateTime('last_accessed_at')->nullable();
            $table->integer('total_time_minutes')->default(0);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('enrolled_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'course_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
