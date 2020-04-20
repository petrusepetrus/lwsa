<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwimClassSwimmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swim_class_swimmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('swim_class_id');
            $table->unsignedBigInteger('swimmer_id');
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
        Schema::dropIfExists('swim_class_swimmers');
    }
}
