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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId("home_team_id")->constrained("teams");
            $table->integer("home_score")->default(0);
            $table->integer("home_shots")->default(0);

            $table->foreignId("visitor_team_id")->constrained("teams");
            $table->integer("visitor_score")->default(0);
            $table->integer("visitor_shots")->default(0);

            $table->string("clock")->default("12:00");
            $table->integer("period")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
