<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder {

    public function run()
    {
        $this->insertPermissions();
        $this->insertRoles();
        $this->linkRolesAndPermissions();
    }

    private function insertPermissions()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('acl_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = config('users.permissions');

        // Add any data to the table.
        DB::table('acl_permissions')->insert($permissions);
    }

    private function insertRoles()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('acl_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = config('users.roles');

        // Add any data to the table.
        DB::table('acl_roles')->insert($roles);
    }

    private function linkRolesAndPermissions()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('acl_permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = config('users.permission_role');

        // Add any data to the table.
        DB::table('acl_permission_role')->insert($permissions);
    }
}
