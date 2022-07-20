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
            $table->string("last_name");
            $table->date("date_birth")->nullable();
            $table->string("city")->nullable();
            $table->string("university")->nullable();
            $table->year("graduation_year")->nullable();
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
            $table->dropColumn("last_name");
            $table->dropColumn("date_birth");
            $table->dropColumn("city");
            $table->dropColumn("university");
            $table->dropColumn("graduation_year");
        });
    }
};
