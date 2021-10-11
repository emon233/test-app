<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('original_name')->nullable();
            $table->string('original_extension')->nullable();
            $table->string('original_mime_type')->nullable();
            $table->string('access_url')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('file_mime_type')->nullable();
            $table->text('file_metadata')->nullable();
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
        Schema::dropIfExists('media');
    }
}
