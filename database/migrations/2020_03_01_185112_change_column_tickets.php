<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Doctrine\DBAL\Types\Type;

class ChangeColumnTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType("uuid")) {
            Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        }
        Schema::table('tickets', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Type::hasType("uuid")) {
            Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        }
        Schema::table('tickets', function (Blueprint $table) {
            $table->uuid('uuid')->change();
        });
    }
}
