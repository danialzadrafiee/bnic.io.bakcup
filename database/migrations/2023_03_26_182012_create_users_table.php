<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            //global
            $table->string('user_type');

            $table->longText('cv')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('telegram')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('wallpaper_image')->nullable();
            $table->string('profile_nft_id')->nullable();
            $table->string('token')->nullable();

            //invidual
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('country_primary')->nullable();
            $table->string('state_primary')->nullable();
            $table->string('country_secondary')->nullable();
            $table->string('state_secondary')->nullable();
            $table->string('wallet')->nullable();
            $table->json('edu_country')->nullable();
            $table->json('edu_univercity')->nullable();
            $table->json('edu_field')->nullable();
            $table->json('edu_degree')->nullable();
            $table->json('profession')->nullable();
            $table->json('skill')->nullable();
            $table->json('language')->nullable();

            //invidual_publicity
            $table->string('i_pub_first_name')->default(1);
            $table->string('i_pub_last_name')->default(1);
            $table->date('i_pub_birthday')->default(1);
            $table->string('i_pub_gender')->default(1);
            $table->string('i_pub_email')->default(1);
            $table->string('i_pub_country_primary')->default(1);
            $table->string('i_pub_state_primary')->default(1);
            $table->string('i_pub_country_secondary')->default(1);
            $table->string('i_pub_state_secondary')->default(1);
            $table->string('i_pub_wallet')->default(1);
            $table->json('i_pub_edu_country')->default(1);
            $table->json('i_pub_edu_univercity')->default(1);
            $table->json('i_pub_edu_field')->default(1);
            $table->json('i_pub_edu_degree')->default(1);
            $table->json('i_pub_profession')->default(1);
            $table->json('i_pub_skill')->default(1);
            $table->json('i_pub_language')->default(1);


            //corporation
            $table->string('corp_name')->nullable();
            $table->string('corp_establishment')->nullable();
            $table->string('corp_cat_pri')->nullable();
            $table->string('corp_cat_sec')->nullable();
            $table->string('corp_type')->nullable();
            $table->string('corp_country_pri')->nullable();
            $table->string('corp_state_pri')->nullable();
            $table->string('corp_country_sec')->nullable();
            $table->string('corp_state_sec')->nullable();
            $table->string('corp_form')->nullable();
            $table->string('corp_link')->nullable();
            $table->string('corp_cv')->nullable();
            $table->string('corp_file')->nullable();
            //corporation_publicity
            $table->string('pub_corp_name')->default(1);
            $table->string('pub_corp_establishment')->default(1);
            $table->string('pub_corp_cat_pri')->default(1);
            $table->string('pub_corp_cat_sec')->default(1);
            $table->string('pub_corp_type')->default(1);
            $table->string('pub_corp_country_pri')->default(1);
            $table->string('pub_corp_state_pri')->default(1);
            $table->string('pub_corp_country_sec')->default(1);
            $table->string('pub_corp_state_sec')->default(1);
            $table->string('pub_corp_form')->default(1);
            $table->string('pub_corp_link')->default(1);
            $table->string('pub_corp_cv')->default(1);
            $table->string('pub_corp_file')->default(1);

            //admin
            $table->string('isAdmin')->default(0);



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
        Schema::dropIfExists('users');
    }
}
