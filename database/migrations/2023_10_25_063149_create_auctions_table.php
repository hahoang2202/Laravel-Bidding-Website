<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->string('image');
            $table->unsignedBigInteger('min_price')->nullable()->default(0);
            $table->unsignedBigInteger('current_price')->nullable()->default(0);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->timestamp('start_time')->nullable();

            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('winner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->enum('status', ['active', 'ended'])->default('active');

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
        Schema::dropIfExists('auctions');
    }
}
