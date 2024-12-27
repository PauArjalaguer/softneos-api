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
           
            Schema::create('event_seats', function (Blueprint $table) {
                $table->unsignedBigInteger('event_id');
                $table->unsignedBigInteger('seat_id');
    
                $table->primary(['event_id', 'seat_id']);
    
               // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('no action');
                //$table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade')->onUpdate('no action');
                $table->foreign('seatstatus_id')
                ->references('id')->on('seatstatus')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
                $table->timestamps();
            });

          

    }

    public function down(): void
    {
        Schema::dropIfExists('event_seats');
    }
};
