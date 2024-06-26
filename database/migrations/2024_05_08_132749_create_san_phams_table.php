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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->string('thumbnail');
            $table->string('slug_san_pham');
            $table->string('gia_ban');
            $table->string('gia_khuyen_mai');
            $table->string('mo_ta');
            $table->integer('id_dai_ly');
            $table->integer('id_danh_muc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
