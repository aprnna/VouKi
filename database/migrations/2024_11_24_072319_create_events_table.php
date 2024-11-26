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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->integer('max_volunteers');
            $table->string('banner');
            $table->enum('category', ['music', 'sport', 'education', 'technology', 'art', 'fashion', 'food', 'other'])->default('other');
            $table->enum('prefered_skills', ['it', 'design', 'marketing', 'finance', 'comunication', 'leader', 'other'])->default('other');
            $table->date('RegisterStart');
            $table->date('RegisterEnd');
            $table->date('EventStart');
            $table->date('EventEnd');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->primary(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
