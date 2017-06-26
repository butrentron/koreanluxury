<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('slug', 100);
            $table->string('description');
            $table->string('image');
            $table->string('set_title', 70);
            $table->string('meta_key');
            $table->string('meta_desc', 160);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('desc');
            $table->longText('content');
            $table->string('image');
            $table->string('size');
            $table->string('color');
            $table->integer('view');
            $table->integer('order');
            $table->tinyInteger('sale');
            $table->decimal('price', 15,0);
            $table->enum('slide', ['0', '1', '2'])->default(0);
            $table->string('set_title', 70);
            $table->string('meta_key');
            $table->string('meta_desc', 160);

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('description');
            $table->boolean('display')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->string('set_title', 70);
            $table->string('meta_key');
            $table->string('meta_desc', 160);
            $table->timestamps();
        });

        Schema::create('product_type', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')
                ->references('id')
                ->on('types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
        
            $table->primary(['type_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('brands');
        Schema::drop('product_type');
        Schema::drop('products');
        Schema::drop('types');
    }
}
