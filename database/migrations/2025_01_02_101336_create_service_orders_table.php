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
    Schema::create('service_orders', function (Blueprint $table) {
        $table->id();
        $table->string('status');
        $table->timestamps(); // Cria 'created_at' e 'updated_at'
    });
}

public function down()
{
    Schema::dropIfExists('service_orders');
}

};
