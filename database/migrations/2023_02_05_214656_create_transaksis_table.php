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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
<<<<<<< Updated upstream:database/migrations/2023_02_05_214656_create_transaksis_table.php
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->integer('jmlbayar')->nullable();
=======
            $table->string('nama_member');
            $table->string('notelp');
            $table->string('alamat');
            $table->string('status')->default('1');
            $table->string('keluhan');
            $table->string('jk');
>>>>>>> Stashed changes:database/migrations/2023_06_23_153318_create_members_table.php
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
        Schema::dropIfExists('transaksis');
    }
};
