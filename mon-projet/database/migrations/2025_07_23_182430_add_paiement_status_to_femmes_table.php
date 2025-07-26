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
    Schema::table('femmes', function (Blueprint $table) {
        $table->boolean('paiement_status')->default(false);
    });
}

public function down()
{
    Schema::table('femmes', function (Blueprint $table) {
        $table->dropColumn('paiement_status');
    });
}

};
