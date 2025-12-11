<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->renameColumn('entrada_impressao', 'entrada_impressao_e_laser');
        });
    }

    public function down()
    {
        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->renameColumn('entrada_impressao_e_laser', 'entrada_impressao');
        });
    }
};
