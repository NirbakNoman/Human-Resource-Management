<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_emergency_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('contact_name',300)->nullable();
            $table->string('contact_relation',300)->nullable();
            $table->string('contact_home_telephone',300)->nullable();
            $table->string('contact_mobile',300)->nullable();

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
        Schema::dropIfExists('employee_emergency_contacts');
    }
}
