<?php

use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

      $professionId = Profession::where('title','Desarrollador Back-end')->value('id');

        Factory(User::class)->create([

            'name'=> 'Joel Celaya',
            'email' => 'joelcluna@gmail.com',
            'password' => bcrypt('joelcluna'),
            'profession_id' => $professionId,
            'is_admin' => true,
        ]);

        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        factory(User::class, 48)->create();


    }
}
