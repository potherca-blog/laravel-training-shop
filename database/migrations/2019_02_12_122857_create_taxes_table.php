<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {

            $table->increments('id');
            
            $table->string('name');

            $table->integer('value')->default(0);

            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('tax_id')->unsigned()->nullable();

            $table->foreign('tax_id')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tax_id']);
            $table->dropColumn(['tax_id']);
        });
        
        Schema::dropIfExists('taxes');
    }
}
