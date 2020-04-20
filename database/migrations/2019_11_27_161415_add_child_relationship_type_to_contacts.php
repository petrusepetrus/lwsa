<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChildRelationshipTypeToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('child_relationship_type_id')->nullable();
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
            $table->dropIfExists('child_relationsihp_type_id');
        });
    }
}
