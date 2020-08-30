<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->bigInteger('referrer_categories_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('text');
             // TODO: relacion con imagenes de muchos a muchos imagenes al final igual que slug         

            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('articles_tags', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('article_id')->unsigned();
            $table->unsignedBigInteger('tag_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_has_tags');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
}
