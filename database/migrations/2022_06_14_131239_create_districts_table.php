<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(District::getTableName(), function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("division_id")
                ->nullable()
                ->references("id")
                ->on(Division::getTableName())
                ->onUpdate("cascade")
                ->onDelete("set null");

            $table->string("name");
            $table->string("bn_name")->nullable();
            $table->string("lat")->nullable();
            $table->string("lon")->nullable();
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
        Schema::dropIfExists(District::getTableName());
    }
};
