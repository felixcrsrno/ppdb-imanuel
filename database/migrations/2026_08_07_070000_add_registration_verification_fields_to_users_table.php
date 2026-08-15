<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Laravel's default users migration already creates this column.
        // Keep this fallback for older databases that do not have it yet.
        if (!Schema::hasColumn('users', 'email_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'registration_code_hash')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('registration_code_hash')->nullable()->after('email_verified_at');
            });
        }

        if (!Schema::hasColumn('users', 'registration_code_expires_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('registration_code_expires_at')->nullable()->after('registration_code_hash');
            });
        }

        if (!Schema::hasColumn('users', 'registration_code_sent_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('registration_code_sent_at')->nullable()->after('registration_code_expires_at');
            });
        }

        // Akun yang sudah ada sebelum fitur ini tetap dapat digunakan.
        DB::table('users')->whereNull('email_verified_at')->update([
            'email_verified_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'registration_code_hash',
                'registration_code_expires_at',
                'registration_code_sent_at',
            ]);
        });
    }
};

