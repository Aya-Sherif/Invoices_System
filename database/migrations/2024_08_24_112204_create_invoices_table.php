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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('invoice_identifier')->unique(); //

            $table->date('invoice_date');
            $table->decimal('total_before_discount', 10, 2);
            $table->decimal('total_after_discount', 10, 2);
            $table->decimal('paid', 10, 2);
            $table->enum('status', ['draft', 'approved', 'shipped'])->default('draft'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
