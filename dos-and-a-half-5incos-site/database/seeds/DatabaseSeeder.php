<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userAccounts = array(
          ["Ben Sumali", "bensumali@gmail.com", "whocares"]
        );

        foreach($userAccounts as $user) {
            $account = new \App\User();
            $account->name = $user[0];
            $account->email = $user[1];
            $account->password = $user[2];
            $account->save();
        }

        // $this->call(UserSeeder::class);
    }
}
