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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso3', 3)->nullable();              // Mã ISO 3 ký tự
            $table->string('numeric', 3)->nullable();           // Mã số quốc gia
            $table->string('ios2', 2)->nullable();              // Mã ISO 2 ký tự (gõ đúng là "iso2" nếu là tên chuẩn)
            $table->string('phonecode')->nullable();            // Mã điện thoại quốc gia
            $table->string('capital')->nullable();              // Thủ đô
            $table->string('currency', 10)->nullable();         // Mã tiền tệ (VD: VND, USD)
            $table->string('currency_name')->nullable();        // Tên tiền tệ (VD: Vietnamese dong)
            $table->string('tld')->nullable();                  // Tên miền quốc gia (VD: .vn)
            $table->string('native')->nullable();               // Tên bản địa
            $table->string('region')->nullable();               // Khu vực (VD: Asia)
            $table->string('subregion')->nullable();            // Tiểu khu vực
            $table->json('timezones')->nullable();              // Múi giờ (dạng JSON)
            $table->json('translations')->nullable();           // Dịch tên quốc gia (dạng JSON)
            $table->decimal('latitude', 10, 8)->nullable();     // Vĩ độ
            $table->decimal('longitude', 11, 8)->nullable();    // Kinh độ
            $table->string('emoji', 10)->nullable();            // Cờ emoji
            $table->string('emojiU')->nullable();               // Unicode của emoji
            $table->boolean('status')->default(true);           // Trạng thái (true: hoạt động)
            $table->string('flag')->nullable();                 // Đường dẫn/cờ
            $table->string('wikiDataId')->nullable();           // ID liên kết đến WikiData

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
