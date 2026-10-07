<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending', 'confirmed', 'shipped', 'completed', 'cancelled') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};