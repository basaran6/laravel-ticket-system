<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('body');
            $table->unsignedBigInteger('ticket_type_id');
            $table->unsignedBigInteger('ticket_status_id');
            $table->unsignedBigInteger('ticket_priority_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('agent_id')->references('id')->on('users');
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priorities');
            $table->foreign('ticket_status_id')->references('id')->on('ticket_statuses');
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types');
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
        Schema::dropIfExists('tickets');
    }
}
