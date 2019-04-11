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
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Батов',
                'fn' => 'Иван',
                'pt' => 'Николаевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Дорожков',
                'fn' => 'Кирилл',
                'pt' => 'Дмитриевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Дворников',
                'fn' => 'Дмитрий',
                'pt' => 'Валерьевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Дубровский',
                'fn' => 'Дмитрий',
                'pt' => 'Алексеевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Запертов',
                'fn' => 'Иван',
                'pt' => 'Дмитриеивч',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Зейналов',
                'fn' => 'Магеррам',
                'pt' => 'Гилал Оглы',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Зыков',
                'fn' => 'Александр',
                'pt' => 'Алексеевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Квасов',
                'fn' => 'Алексей',
                'pt' => 'Владиславович',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-07-18')->get()->first()->id,
            ],
            [
                'sn' => 'Набиев',
                'fn' => 'Анушервон',
                'pt' => 'Сухробшоевич',
                'group_id' => DB::table("Groups")->where('name', 'ИКБО-12-18')->get()->first()->id,
            ],
        ]);
    }
}
