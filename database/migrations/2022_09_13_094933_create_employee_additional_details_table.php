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
        Schema::create('employee_additional_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('step_completed')->nullable();
            $table->string('dropbox_url')->nullable();
            $table->string('google_drive')->nullable();
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
        Schema::dropIfExists('employee_additional_details');
    }
};
