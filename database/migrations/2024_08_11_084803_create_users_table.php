<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
//            $table->id('product_id');
            $table->increments('user_id');
            $table->string('user_name', 150);
            $table->smallInteger('age')->unsigned();
            $table->string('phone',14 )->unique()->nullable();
            $table->timestamps();
            $table->timestamp('some_update')->useCurrent()->useCurrentOnUpdate();
        });
    }
    /**

     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
