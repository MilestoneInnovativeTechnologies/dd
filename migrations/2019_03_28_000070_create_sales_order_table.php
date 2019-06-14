<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('docno', '20')->nullable()->index();
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignNullable('user', 'users');
            $table->foreignNullable('customer', 'users');
            $table->char('fycode', '5')->nullable()->index();
            $table->char('fncode', '5')->nullable()->index();
            $table->enum('progress', ['Incomplete','Partial','Completed'])->nullable()->default('Incomplete');
            $table->char('_ref', '30')->nullable()->index();
            $table->enum('status', ['Active','Inactive'])->nullable()->default('Active');
            $table->audit();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order');
    }
}
