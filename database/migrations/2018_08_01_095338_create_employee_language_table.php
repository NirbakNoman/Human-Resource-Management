<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_language', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('language_id')->nullable();
            $table->integer('fluency_type')->nullable();
            $table->integer('competency_type')->nullable();
            $table->string('comments',250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_language');
    }
}
