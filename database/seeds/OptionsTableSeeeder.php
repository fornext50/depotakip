<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'key' => 'kayit_durum',
            'value' => true,
        ]);
    }
}
