<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',200)->nullable();
            $table->string('middle_name',200)->nullable();
            $table->string('last_name',200)->nullable();
            $table->string('employee_code',200)->nullable();
            $table->string('national_id',200)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender',50)->nullable();
            $table->string('marital_status',50)->nullable();
            $table->string('passport_number',50)->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('driving_license_number',50)->nullable();
            $table->date('license_expiry_date')->nullable();

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
        Schema::dropIfExists('employees');
    }
}
