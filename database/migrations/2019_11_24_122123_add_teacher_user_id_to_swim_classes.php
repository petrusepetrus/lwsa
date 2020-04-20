<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherUserIdToSwimClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('swim_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('swim_classes', function (Blueprint $table) {
            $table->dropIfExists('teacher_user_id');
        });
    }
}
