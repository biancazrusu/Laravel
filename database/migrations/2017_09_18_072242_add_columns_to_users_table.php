<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job');
            $table->string('location');
            $table->string('type');
            $table->string('interested_in');
            $table->string('subscribed');
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
            $table->dropColumn('job');
            $table->dropColumn('location');
            $table->dropColumn('type');
            $table->dropColumn('interested_in');
            $table->dropColumn('subscribed');
        });
    }
}
