<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class InitUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize default users';

    /**
     * The users to be created
     *
     */
    private $users_data = [
        [
            'name' => 'Super Administrator',
            'email' => 'superadmin@mylib.info',
            'password' => 'superadminpass',
            'type' => 'superAdmin',
        ],
        [
            'name' => 'Admin A',
            'email' => 'admina@mylib.info',
            'password' => 'adminapass',
            'type' => 'admin',
        ],
        [
            'name' => 'Admin B',
            'email' => 'adminb@mylib.info',
            'password' => 'adminbpass',
            'type' => 'admin',
        ],
        [
            'name' => 'User',
            'email' => 'user@mylib.info',
            'password' => 'userpass',
            'type' => 'user',
        ],
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach($this->users_data as $user_data) {
            $user = new User;
            $user->name = $user_data['name'];
            $user->email = $user_data['email'];
            $user->password = bcrypt($user_data['password']);
            $user->type = $user_data['type'];
            $user->save();

            echo "User $user->email created successfully\n";
        }
    }
}
