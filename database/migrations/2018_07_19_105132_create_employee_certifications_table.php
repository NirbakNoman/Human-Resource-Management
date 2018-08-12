<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('certification',200);
            $table->string('institute',200);
            $table->date('granted_on');
            $table->date('valid_till');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_certifications');
    }
}
