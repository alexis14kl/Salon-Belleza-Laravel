<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        $now = now();
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'ADMINISTRADOR', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nombre' => 'CLIENTE', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nombre' => 'PROSPECTO', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nombre' => 'COLABORADOR', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'nombre' => 'PROVEEDOR', 'created_at' => $now, 'updated_at' => $now],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
        });

        DB::table('users')->insert([
            [
                'name' => 'developElver',
                'email' => 'developerelver@admin.com',
                'password' => Hash::make('root'),
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'developAlexis',
                'email' => 'developalexis@admin.com',
                'password' => Hash::make('root'),
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
};
