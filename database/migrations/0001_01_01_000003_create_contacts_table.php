<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');           // фамилия
            $table->string('first_name');          // имя
            $table->string('middle_name')->nullable(); // отчество
            $table->enum('gender', ['M', 'F']);    // пол
            $table->date('birth_date')->nullable(); // дата рождения
            $table->string('phone', 30)->nullable(); // телефон
            $table->string('address')->nullable();  // адрес
            $table->string('email')->nullable();    // е-майл
            $table->text('comment')->nullable();    // комментарий
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
