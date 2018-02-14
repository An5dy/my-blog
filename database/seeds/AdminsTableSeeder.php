<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('admins')->insert([
                'name' => config('global.admin.name'),
                'password' => bcrypt(config('global.admin.password')),
                'created_at' => $time,
                'updated_at' => $time,
            ]);
    }
}
