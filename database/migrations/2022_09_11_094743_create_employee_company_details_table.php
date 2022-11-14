<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_company_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('employee_id');
            $table->string('department_id')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('assigned_manager_id')->nullable();
            $table->date('doj')->comment('Date of Joining');
            $table->date('dol')->comment('Date of Leaving')->nullable();
            $table->enum('status', ['enable', 'disable'])->default('enable');
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
        Schema::dropIfExists('employee_company_details');
    }
};
