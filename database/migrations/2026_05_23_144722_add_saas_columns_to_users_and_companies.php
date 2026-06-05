<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Añadir el flag de Dios al usuario
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_superadmin')->default(false)->after('email');
        });

        // 2. Añadir control de pagos a las empresas
        Schema::table('companies', function (Blueprint $table) {
            $table->enum('status', ['active', 'suspended', 'trial'])->default('trial')->after('name');
            $table->date('valid_until')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_superadmin');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['status', 'valid_until']);
        });
    }
};