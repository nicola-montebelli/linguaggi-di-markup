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
        Schema::create('products', function (Blueprint $table) {
            $table->id();  //di default è già in auto-increment
            $table->string('name', 50);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->text('description')->nullable();
            ##primo metodo per creare una foreign key
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            //cascade significa che se elimino la tabella categories vengono eliminati anche i prodotti collegati
            //sarebbe più sicuro mettere set null
            
            ##altro metodo (più usato nelle vecchie versioni di laravel)
            // $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            // $table->index('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
