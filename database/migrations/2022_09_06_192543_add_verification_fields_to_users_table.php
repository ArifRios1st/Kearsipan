<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        User::all()->each(function (User $user) {
            $user->update([
                'verified'    => true,
                'verified_at' => now(),
            ]);
        });
    }
};
