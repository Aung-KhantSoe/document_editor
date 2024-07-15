<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableEnableForeignChecks;

class UserSeeder extends Seeder
{
    use TruncateTable,DisableEnableForeignChecks;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $user = User::create([
        //     'name'      => 'AKS',
        //     'email'     => 'aks@gmail.com',
        //     'password'  => bcrypt('password')
        // ]);

        // $user->createToken('AKS')->plainTextToken;

        // User::factory()->count(5)->create();
        $this->disableforeignchecks();
        $this->truncatetable('users');
        $user = User::factory(10)->create();
        $this->enableforeignchecks();
    }
}
