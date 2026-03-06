<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('categoria', 50);
            $table->integer('stock')->default(0);

            $table->unsignedBigInteger('tipo_producto_id');
            $table->integer('duracion_dias')->nullable()->after('precio');
            $table->timestamps();

            $table->foreign('tipo_producto_id')
                  ->references('id')
                  ->on('tipo_producto')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
