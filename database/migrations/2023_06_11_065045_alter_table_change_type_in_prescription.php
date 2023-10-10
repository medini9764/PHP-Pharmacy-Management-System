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
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->text('delivery_address')->nullable()->change();
            $table->text('delivery_time')->nullable()->change();
            $table->text('note')->nullable()->change();
            $table->string('image_1')->nullable()->change();
            $table->string('image_2')->nullable()->change();
            $table->string('image_3')->nullable()->change();
            $table->string('image_4')->nullable()->change();
            $table->string('image_5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //
        });
    }
};
