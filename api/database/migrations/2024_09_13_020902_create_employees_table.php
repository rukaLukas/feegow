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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique();
            $table->string('name', 100);
            $table->date('date_of_birth');
            $table->boolean('comorbidities')->default(false);
            $table->timestamps();

            $table->index(['name', 'cpf']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
