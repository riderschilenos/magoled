<?php

use App\Models\Lote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();

            $table ->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->enum('estado',[Lote::PENDIENTE,Lote::FINALIZADO])->default(Lote::PENDIENTE);


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
        Schema::dropIfExists('lotes');
    }
}
