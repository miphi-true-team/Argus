<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("Groups")->insert([
            [
                'name' => 'ИКБО-07-18'
            ],
            [
                'name' => 'ИКБО-08-18'
            ],
            [
                'name' => 'ИКБО-09-18'
            ],
            [
                'name' => 'ИКБО-10-18'
            ],
            [
                'name' => 'ИКБО-11-18'
            ],
            [
                'name' => 'ИКБО-12-18'
            ],
            [
                'name' => 'ИКБО-13-18'
            ],
            [
                'name' => 'ИКБО-14-18'
            ],
        ]);
    }
}
