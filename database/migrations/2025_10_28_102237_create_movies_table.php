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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_visible')->default(true);
            $table->json('title');
            $table->json('description')->nullable();
            $table->string('poster')->nullable();
            $table->json('screenshots')->nullable();
            $table->string('trailer_id_youtube')->nullable();
            $table->integer('year')->nullable();
            $table->date('watch_start_date')->nullable();
            $table->date('watch_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
