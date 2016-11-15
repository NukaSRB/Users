<?php

use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    public function run()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $statuses = [
            [
                'name'  => 'active',
                'label' => 'Active',
            ],
            [
                'name'  => 'inactive',
                'label' => 'Inactive',
            ],
            [
                'name'  => 'blocked',
                'label' => 'Blocked',
            ],
        ];

        // Add any data to the table.
        DB::table('user_statuses')->insert($statuses);
    }
}
