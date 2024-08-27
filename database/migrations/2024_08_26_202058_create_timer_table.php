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
        Schema::create('timer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->integer('id_pomo')->nullable();
            $table->text('temp_completo_min')->nullable();
            $table->text('temp_completo_sec')->nullable();
            $table->text('foco_min')->nullable();
            $table->text('foco_sec')->nullable();
            $table->text('descanso_min')->nullable();
            $table->text('descanso_sec')->nullable();
            $table->text('start')->nullable();
            $table->text('stop')->nullable();
            $table->text('reset')->nullable();
            $table->integer('foco_fim')->nullable();
            $table->integer('descanso_fim')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timer');
    }
};
