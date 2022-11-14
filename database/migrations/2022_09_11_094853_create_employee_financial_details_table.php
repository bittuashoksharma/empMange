<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
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
        Schema::create('employee_financial_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->double('basic_salary', 20, 2);
            $table->json('allowances')->default(new Expression('(JSON_ARRAY())'))->nullable();
            $table->json('deductions')->default(new Expression('(JSON_ARRAY())'))->nullable();
            $table->double('monthly_salary', 20, 2)->nullable();
            $table->double('yearly_salary', 20, 2)->nullable();
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
        Schema::dropIfExists('employee_financial_details');
    }
};
