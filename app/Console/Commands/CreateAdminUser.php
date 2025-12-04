<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating an admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $name = $this->argument('name');
            $email = $this->argument('email');
            $psw = bcrypt($this->argument('password'));

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $psw
            ]);

            $user->email_verified_at = now();
            $user->assignRole('admin');
            $user->save();
        });
    }
}
