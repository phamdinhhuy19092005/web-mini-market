<?php

use App\Enum\UserActionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->unique();
            $table->string('currency_code')->nullable()->default('VND');
            $table->timestamp('last_logged_in_at')->nullable();
            $table->tinyInteger('status')->comment(UserActionEnum::class);
            $table->date('birthday')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('avatar')->nullable();
            $table->string('access_channel_type')->nullable();
            $table->boolean('allow_login')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
