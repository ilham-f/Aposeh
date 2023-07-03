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
        Schema::create('detail__obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->constrained('obats')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('pembelian_id')->constrained('pembelians')->onDelete('cascade');
            $table->integer('jml_obat')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('dosis_hari')->nullable();
            $table->integer('dosis_obat')->nullable();
            $table->dateTime('estimasi_habis')->nullable();
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
        Schema::dropIfExists('detail__obats');
    }
};
