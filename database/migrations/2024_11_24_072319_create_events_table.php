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
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            // $table->string('location');
            // $table->integer('max_participants');
            $table->string('banner');
            // $table->enum('category', ['music', 'sport', 'education', 'technology', 'art', 'fashion', 'food', 'other'])->default('other');
            // $table->enum('prefered_skills',['it', 'design', 'marketing', 'finance','comunication','leader' ,'other'])->default('other');
            // $table->dateTime('RegisterStart');
            // $table->dateTime('RegisterEnd');
            // $table->dateTime('EventStart');
            // $table->dateTime('EventEnd');
            $table->timestamps();
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
