<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // firstname
            $table->string('firstname', length: 30);
            // lastname
            $table->string('lastname', length: 30);
            // address
            $table->text('address');
            // contact
            $table->string('contact', length: 30);
            // email
            $table->string('email', length: 50);
            // notes
            $table->text('notes');
            // total
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
