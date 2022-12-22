<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Upazila;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Upazila::getTableName(), function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("district_id")
                ->nullable()
                ->references("id")
                ->on(District::getTableName())
                ->onUpdate("cascade")
                ->onDelete("set null");

            $table->string("name");
            $table->string("bn_name")->nullable();
            $table->string("url")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Upazila::getTableName());
    }
};
