<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream:database/migrations/2022_09_24_143018_create_categories_table.php
            $table->string('nama')->unique();
=======
            $table->string('no_pengirim');
            $table->string('no_penerima');
            $table->text('isi');
            $table->string('status')->default('1');
>>>>>>> Stashed changes:database/migrations/2023_06_23_153341_create_chats_table.php
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
        Schema::dropIfExists('categories');
    }
}
