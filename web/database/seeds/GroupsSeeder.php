<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    public function run()
    {
        DB::table("Groups")->insert([
            [
                'name' => 'Б18-101'
            ],
            [
                'name' => 'Б18-102'
            ],
            [
                'name' => 'Б18-103'
            ],
            [
                'name' => 'Б18-104'
            ],
            [
                'name' => 'Б18-105'
            ],
        ]);
    }
}
