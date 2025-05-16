<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->string('designation')->nullable()->after('workplace_logo');
            $table->string('year')->nullable()->after('designation'); // string to allow "2018 to Present"
        });
    }
    
    public function down()
    {
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->dropColumn(['designation', 'year']);
        });
    }
    
};
