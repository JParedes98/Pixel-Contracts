<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name_rep', 60)->nullable();
            $table->string('social_reason', 60)->nullable();
            $table->string('rtn',24)->unique()->nullable();
            $table->string('n_identidad',24)->nullable ();
            $table->string('m_status',24)->nullable ();
            $table->string('contact', 30)->nullable();
            $table->string('adress', 80)->nullable();
            $table->string('tel', 20)->nullable();
            $table->string('email', 40);
            $table->date('date', 30)->nullable();
            $table->boolean('status')->default(false);
            $table->text('signature')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}