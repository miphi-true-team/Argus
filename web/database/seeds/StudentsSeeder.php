<?php

use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Students')->insert([
            [
                'sn' => 'Басыров',
                'fn' => 'Сергей',
                'pt' => 'Амирович',
                'group_id' => 1,
            ],
        ]);
    }
}
