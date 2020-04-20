<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactTypeToContactContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_relationship_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_contact', function (Blueprint $table) {
            $table->dropIfExists('parent_relationsihp_type_id');
        });
    }
}
