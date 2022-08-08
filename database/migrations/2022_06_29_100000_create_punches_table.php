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
        Schema::create('punches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('ordernum')->nullable();
            $table->string('year')->nullable();
            $table->float('size-length', 6, 2)->unsigned();
            $table->float('size-width', 6, 2)->unsigned();
            $table->float('size-height', 6, 2)->unsigned()->nullable();
            $table->float('knife-size-length', 6, 2)->unsigned();
            $table->float('knife-size-width', 6, 2)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punches');
    }
};
