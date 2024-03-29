<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
        ->count(3)
        ->state(new Sequence(
            ['username'=>'koki','role' => 'koki'],
            ['username' => 'pelayan','role' => 'pelayan'],
            ['username' => 'kasir','role' => 'kasir'],
        ))
        ->create();
        
 //       \App\Models\Meja::factory()
 //       ->count(6)
  //      ->sequence(fn ($sequence) => ['no_meja' => $sequence->index+1])
  //      ->create();
    }
}
