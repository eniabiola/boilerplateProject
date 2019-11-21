<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_invites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('email');
            $table->unsignedBigInteger('company_id');
            $table->text('slug');
            $table->timestamps();

            //Foreign Key
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_invites');
    }
}
