<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable();
            $table->date("date_birth")->nullable();
            $table->integer("city")->nullable()->unsigned();
            $table->integer("university")->nullable()->unsigned();
            $table->integer("graduation_year")->nullable()->unsigned();
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
            $table->dropColumn("profile_image");
            $table->dropColumn("date_birth");
            $table->dropColumn("city");
            $table->dropColumn("university");
            $table->dropColumn("graduation_year");
        });
    }
};
