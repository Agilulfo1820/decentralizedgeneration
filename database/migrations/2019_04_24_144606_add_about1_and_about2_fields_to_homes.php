<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAbout1AndAbout2FieldsToHomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homes', function (Blueprint $table) {
           $table->string('about1_title');
           $table->mediumText('about1_text');
           $table->string('about1_image');

           $table->string('about2_title');
           $table->mediumText('about2_text');
           $table->string('about2_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn('about1_title');
            $table->dropColumn('about1_text');
            $table->dropColumn('about1_image');
 
            $table->dropColumn('about2_title');
            $table->dropColumn('about2_text');
            $table->dropColumn('about2_image');
        });
    }
}
