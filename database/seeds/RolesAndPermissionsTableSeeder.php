use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
	{
    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'user', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role->givePermissionTo('list users');
        $role->givePermissionTo('create users');
        $role->givePermissionTo('edit users');
        $role->givePermissionTo('delete users');

        $role = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
    }
}
