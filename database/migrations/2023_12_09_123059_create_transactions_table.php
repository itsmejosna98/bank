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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id')->default(null);
            $table->unsignedBigInteger('to_user_id')->default(null);
            $table->string('type');
            $table->string('details');
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->foreign('from_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

                $table->foreign('to_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
