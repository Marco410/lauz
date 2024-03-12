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
        Schema::create('quiz', function (Blueprint $table) {
            $table->id();
            $table->string('how_long_invest');
            $table->string('how_often_invest');
            $table->string('looking');
            $table->string('investment_type');
            $table->timestamps();
            
        });

        Schema::table('quiz', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('quiz'); 

      Schema::table('quiz', function (Blueprint $table) {
        $table->dropForeign('quiz_user_id_foreign');
        $table->dropColumn('pais_id');
    });
    }
};
