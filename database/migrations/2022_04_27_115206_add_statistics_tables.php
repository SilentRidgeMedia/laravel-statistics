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
        Schema::create('raw_statistics', function(Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->json('data');
            $table->timestamps();
        });

        Schema::create('normalized_statistics', function(Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->json('data');
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
        Schema::drop('raw_statistics');
        Schema::drop('normalized_statistics');
    }
};
