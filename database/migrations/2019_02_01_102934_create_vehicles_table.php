<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            //Main Description
            $table->string('mileage')->nullable();
            $table->date('registration')->nullable();
            $table->string('gear')->nullable();
            $table->string('wheeldrive')->nullable();
            $table->string('fuel')->nullable();
            $table->float('displacement')->nullable();
            $table->string('body')->nullable();
            $table->string('interior')->nullable();
            $table->string('exterior_color')->nullable();
            $table->integer('seats')->nullable();
            $table->string('transported_by')->nullable();
            $table->longText('special_equipment')->nullable();
            $table->longText('serial_equipment')->nullable();
            $table->longText('vehicle_description')->nullable();
            $table->longText('condition')->nullable();
            $table->longText('financial_services')->nullable();
            $table->string('type');

            $table->string('auction_id');
            $table->foreign('auction_id')
                ->references('id')->on('auctions')
                ->onDelete('cascade');
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
        Schema::dropIfExists('vehicles');
    }
}
