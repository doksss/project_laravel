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
        Schema::table('products',function(Blueprint $table){
            $table->string('name');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->string('state');
            $table->double('longitude',8,3);
            $table->double('latitude',8,3);
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('currency')->nullable();
            $table->string('accommodation_type');
            $table->string('web')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
