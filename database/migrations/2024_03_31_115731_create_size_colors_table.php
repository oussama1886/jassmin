<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_colors', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();
            $table->string('color')->nullable();

            // Ajoutez d'autres colonnes si nécessaire

            $table->timestamps();
        });

        // Table pivot pour gérer la relation many-to-many avec les produits
        Schema::create('product_size_color', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_color_id');
            $table->integer('quantity')->default(0); // Quantité de produits avec cette taille et couleur

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('size_color_id')->references('id')->on('size_colors')->onDelete('cascade');

            $table->unique(['product_id', 'size_color_id']); // Pour s'assurer qu'une taille et une couleur ne sont associées qu'une seule fois à un produit
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_size_color');
        Schema::dropIfExists('size_colors');
    }
}
