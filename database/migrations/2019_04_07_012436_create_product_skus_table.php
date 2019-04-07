<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->increments('id')->comment('自增长ID');
            $table->string('title')->comment('SKU 名称');
            $table->string('description')->comment('SKU 描述');
            $table->decimal('price', 10, 2)->comment('SKU 价格');
            $table->unsignedInteger('stock')->comment('库存');
            $table->unsignedInteger('product_id')->comment('所属商品 id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `product_skus` comment'产品的 SKU 表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_skus');
    }
}
