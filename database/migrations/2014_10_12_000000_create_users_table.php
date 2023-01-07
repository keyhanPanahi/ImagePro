<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('username')->unique();  //کدملی
            $table->string('first_name')->nullable();  //نام
            $table->string('last_name')->nullable();  //نام خانوادگی
            $table->string('email')->unique()->nullable();  //ایمیل
            $table->string('mobile')->unique();  //شماره موبایل
            $table->text('address')->nullable();  //آدرس
            $table->text('avatar')->nullable();  //آواتار
            $table->foreignId('sex_id')->nullable()->constrained('sexes')->onUpdate('cascade')->onDelete('cascade');  //جنسیت
            $table->string('slug');  //اسلاگ
            $table->tinyInteger('status')->default(0);  //وضعیت
            $table->string('password');  //گذرواژه
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
