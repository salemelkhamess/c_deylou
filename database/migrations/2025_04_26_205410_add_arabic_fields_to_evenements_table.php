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
        Schema::table('evenements', function (Blueprint $table) {
            $table->string('titre_ar')->nullable();
            $table->text('description_ar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropColumn('titre_ar');
            $table->dropColumn('description_ar');
        });
    }
};
