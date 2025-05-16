<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDegreeColumnInEducationsTable extends Migration
{
    public function up()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->string('degree')->change();
        });
    }

    public function down()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->enum('degree', ['college', 'highschool'])->change();
        });
    }
}

