<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('users')
            ->insert([
                'name' => 'ze',
                'password' => bcrypt(123456),
                'email' => '846562014@qq.com',
                'created_at' => $time,
                'updated_at' => $time,
            ]);
    }
}
