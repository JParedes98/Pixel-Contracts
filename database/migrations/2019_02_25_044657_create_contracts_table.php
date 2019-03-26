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
            $table->string( 'legal_representative_name', 60)->nullable();
            $table->string( 'legal_representative_rtn',24)->nullable();
            $table->string( 'legal_representative_id_number',24)->nullable ();
            $table->string( 'legal_representative_marital_status',24)->nullable ();
            $table->string( 'contact_name', 30)->nullable();
            $table->string( 'company_social_reason', 60)->nullable();
            $table->string( 'company_adress', 80)->nullable();
            $table->string( 'company_tel', 20)->nullable();
            $table->string( 'company_email', 40);
            $table->date('contract_date', 30)->nullable();
            $table->integer('contract_status')->default(2);
                /*
                    CONTRACT STATUS
                    0 = PENDING
                    1 = COMPLETED
                    2 = EMPTY
                */
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