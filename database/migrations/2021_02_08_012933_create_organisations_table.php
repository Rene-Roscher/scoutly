<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->enum('state', ['FOUNDING', 'ONLINE', 'CLOSURE', 'PENDING'])->default('PENDING');
            $table->longText('logo')->nullable();
            $table->string('homepage');
            $table->string('datacenter');
            $table->string('solution');
            $table->string('legal');
            $table->string('slug')->nullable();
            $table->enum('type', ['B2B', 'B2C'])->default('B2C');
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('opened_at')->nullable();
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
        Schema::dropIfExists('organisations');
    }
}
