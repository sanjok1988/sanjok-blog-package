<?php

namespace Sanjok\Blog\Console\Commands;

use Illuminate\Console\Command;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:createsuperuser {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create super admin';

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
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = new \App\User;
        $user->create(['name'=>$name, 'email'=>$email, 'password'=>$password]);
        $this->info("Super admin created successfully");
    }
}
