<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGraduationYearToStringInEducationsTable extends Migration
{
    public function up()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->string('graduation_year')->change();    /*  2025, "Present",  "Expected 2026", "Ongoing"  */
        });
    }

    public function down()        
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->integer('graduation_year')->change(); // only if it was previously integer
        });
    }
}

