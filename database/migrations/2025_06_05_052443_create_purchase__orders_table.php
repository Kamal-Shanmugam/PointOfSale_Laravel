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
        Schema::create('purchase__orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->dateTime('poDate')->useCurrent();
            $table->foreignId('book_id')    
                ->references('id')
                ->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('quantity')->default(0);


            $table->float('unit_Price')->nullable();
            $table->dateTime('expected_delivery');
            $table->enum('status', ['Processing', 'Received', 'Cancelled'])->default('Processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
