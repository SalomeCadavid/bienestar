<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('edad')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('estatura', 5, 2)->nullable(); // permite hasta 999.99 cm
            $table->enum('genero', ['M', 'F', 'O'])->nullable();
            $table->decimal('imc', 4, 2)->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('rol_id')->nullable();

            $table->timestamps();

            $table->foreign('rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

