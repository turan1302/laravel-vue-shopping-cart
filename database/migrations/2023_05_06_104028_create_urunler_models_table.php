<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urunler', function (Blueprint $table) {
            $table->id('urn_id');
            $table->string('urn_ad')->nullable();
            $table->string('urn_aciklama')->comment('kisa aciklama olacak')->nullable();
            $table->float('urn_fiyat',9,2)->nullable();
            $table->integer('urn_stok')->nullable();
            $table->tinyInteger('urn_durum')->default(1)->comment("0 pasif 1 aktif")->nullable();
            $table->softDeletes();
            $table->timestamp('urn_created_at')->nullable();
            $table->timestamp('urn_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urunler');
    }
};
