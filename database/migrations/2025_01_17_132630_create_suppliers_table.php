<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_suppliers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('IDSupplier');
            $table->string('KodeSupplier')->unique();
            $table->string('NamaSupplier');
            $table->text('Alamat');
            $table->string('NoTelp');
            $table->string('Email')->nullable();
            $table->string('Kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
