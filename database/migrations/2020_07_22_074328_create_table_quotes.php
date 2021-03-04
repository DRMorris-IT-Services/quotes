<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('quote_id');
            $table->string('client_id')->nullable();
            $table->date('quote_date')->nullable();
            $table->date('quote_due')->nullable();
            $table->decimal('net_total',10,2)->nullable();
            $table->decimal('tax_total',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
