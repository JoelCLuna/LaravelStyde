<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//       $profession = DB::select('SELECT id FROM professions WHERE  title = ?',['Desarrollador Back-end']);

      $professionId = DB::table('professions')
            ->where('title','Desarrollador Back-end')
            ->value('id');

        DB::table('users')->insert([

            'name'=> 'Joel Celaya',
            'email' => 'joelcluna@gmial.com',
            'password' => bcrypt('joelcluna'),
            'profession_id' => $professionId,
        ]);
    }
}
