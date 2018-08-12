<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('employee_id');

            $table->string('present_address_street_one',200)->nullable();
            $table->string('present_address_street_two',200)->nullable();
            $table->string('present_address_district',200)->nullable();
            $table->string('present_address_state',200)->nullable();
            $table->string('present_address_zip',50)->nullable();

            $table->string('permanent_address_street_one',200)->nullable();
            $table->string('permanent_address_street_two',200)->nullable();
            $table->string('permanent_address_district',200)->nullable();
            $table->string('permanent_address_state',200)->nullable();
            $table->string('permanent_address_zip',50)->nullable();

            $table->string('home_telephone',50)->nullable();
            $table->string('work_telephone',50)->nullable();
            $table->string('mobile',50)->nullable();

            $table->string('work_mail',50)->nullable();
            $table->string('other_mail',50)->nullable();


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
        Schema::dropIfExists('employee_contacts');
    }
}
