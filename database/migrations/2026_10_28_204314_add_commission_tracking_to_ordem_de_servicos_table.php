<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->dateTime('data_conclusao')->nullable();
        });

        Schema::create('ordem_de_servico_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_de_servico_id')->constrained('ordem_de_servicos')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('percentual', 9, 6);
            $table->timestamps();

            $table->unique(['ordem_de_servico_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordem_de_servico_user');

        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->dropColumn('data_conclusao');
        });
    }
};
