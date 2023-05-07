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
        Schema::create('sepet', function (Blueprint $table) {
            $table->id('spt_id');
            $table->integer('spt_urun')->nullable();
            $table->tinyInteger('spt_urun_adet')->nullable();
            $table->float('spt_urun_fiyat',9,2)->nullable();
            $table->float('spt_tutar',9,2)->nullable();
            $table->softDeletes();
            $table->timestamp('spt_created_at')->nullable();
            $table->timestamp('spt_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepet');
    }
};
