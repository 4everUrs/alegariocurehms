<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newest_collections', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('encoder');
            $table->string('category');
            $table->string('account')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('total_amount');
            $table->string('original')->nullable();
            $table->string('hash')->nullable();
            $table->string('terms')->nullable();
            $table->string('status')->nullable()->default('Unclaimed');
            $table->bigInteger('downpayment')->nullable();
            $table->bigInteger('monthly_payment')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->integer('interest')->nullable();
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
        Schema::dropIfExists('newest_collections');
    }
};
