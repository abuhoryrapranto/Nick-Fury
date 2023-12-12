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
        Schema::create('user_business', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('address_1')->nulllable();
            $table->text('address_2')->nulllable();
            $table->string('postcode')->nulllable();
            $table->string('city')->nulllable();
            $table->string('state')->nulllable();
            $table->string('country')->nulllable();
            $table->string('ti_no')->nulllable();
            $table->string('tl_no')->nulllable();
            $table->string('bi_no')->nulllable();
            $table->string('brand_logo_url')->nulllable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_business');
    }
};
