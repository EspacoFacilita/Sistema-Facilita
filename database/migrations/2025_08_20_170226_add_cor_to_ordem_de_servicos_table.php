<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->string('cor')->nullable()->after('status'); // novo campo
        });
    }

    public function down()
    {
        Schema::table('ordem_de_servicos', function (Blueprint $table) {
            $table->dropColumn('cor');
        });
    }
};
