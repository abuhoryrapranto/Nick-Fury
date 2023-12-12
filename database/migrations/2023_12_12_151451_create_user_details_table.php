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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('address_1')->nulllable();
            $table->text('address_2')->nulllable();
            $table->string('postcode')->nulllable();
            $table->string('city')->nulllable();
            $table->string('state')->nulllable();
            $table->string('country')->nulllable();
            $table->string('ni_no')->nulllable();
            $table->string('passport_no')->nulllable();
            $table->string('profile_img_url')->nulllable();
            $table->string('secondary_email')->nulllable();
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
        Schema::dropIfExists('user_details');
    }
};
