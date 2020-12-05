<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('creative_id');
            $table->unsignedInteger('product_type_id');
            $table->foreign('creative_id')->references('id')->on('creatives')->onDelete('cascade');;
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');;
            $table->timestamps();
        });

        DB::table('product_types')->insert([['name' => 'Fine Art Print'],['name' => 'T Shirts']]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_types');
    }
}
