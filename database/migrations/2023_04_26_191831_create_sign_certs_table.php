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
        Schema::create('sign_certs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('document_id');
            $table->foreignId('corporation_id');
            $table->string('category_id')->nullable()->default(0);
            $table->string('sub_cat_id')->nullable()->default(0);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('data');
            $table->string('reciver')->nullable();
            $table->integer('reciver_verify')->default(0);
            $table->integer('creator_verify')->default(0);
            $table->string('ad_email')->nullable();
            $table->string('ad_role')->nullable();
            $table->string('ad_describe')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sign_certs');
    }
};
