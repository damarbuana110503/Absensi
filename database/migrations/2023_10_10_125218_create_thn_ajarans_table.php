<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThnAjaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thn_ajarans', function (Blueprint $table) {
            // $table->id();
            $table->char('FTHN_AJARAN', 5)->primary();
            $table->double('FBIAYA_SPP')->default(0);
            $table->double('FBIAYA_DSP')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thn_ajarans');
    }
}
