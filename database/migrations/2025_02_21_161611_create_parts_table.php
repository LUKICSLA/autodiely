<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{

    /*
        Part - name, serialnumber, car_id
    */
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // tuto je nazov dielu
            $table->string('serialnumber')->unique();   // seriove cislo dielu
            $table->foreignId('car_id')                 // cudzí kluc na auto - prepojenie dielu s autom
                  ->constrained('cars')                 // odkazem sa na tabuľku cars
                  ->onDelete('cascade');                // pokial bude auto bude vymazane vymazem aj diely, ktore k nemu prisluchaju
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
}