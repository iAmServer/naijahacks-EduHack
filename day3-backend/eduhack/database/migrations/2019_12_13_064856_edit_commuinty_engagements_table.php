<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCommuintyEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_engagements', function (Blueprint $table) {
            $table->dropColumn('activity');
            $table->string('title');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_engagements', function (Blueprint $table) {
            $table->string('activity');
            $table->dropColumn('title');
            $table->dropColumn('url');
        });
    }
}
