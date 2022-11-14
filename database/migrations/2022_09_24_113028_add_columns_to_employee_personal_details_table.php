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
        Schema::table('employee_personal_details', function (Blueprint $table) {
            $table->string('pan_number')->after('gender')->nullable();
            $table->string('adhaar_number')->after('gender')->nullable();
            $table->string('esi_number')->after('gender')->nullable();
            $table->string('pf_account')->after('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_personal_details', function (Blueprint $table) {
            $table->dropColumn(['pan_number','adhaar_number', 'esi_number', 'pf_account']);
        });
    }
};
