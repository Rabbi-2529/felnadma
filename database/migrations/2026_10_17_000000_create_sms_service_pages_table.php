<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsServicePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_service_pages', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->string('slug')->unique();
          $table->string('icon_class')->nullable();
          $table->string('icon_image')->nullable();
          $table->text('short_description')->nullable();
          $table->longText('description')->nullable();
          $table->string('meta_title')->nullable();
          $table->text('meta_description')->nullable();
          $table->text('meta_keywords')->nullable();
          $table->integer('sort_order')->default(0);
          $table->boolean('status')->default(1);
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
        Schema::dropIfExists('sms_service_pages');
    }
}
