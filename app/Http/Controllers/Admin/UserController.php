<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        return Inertia::render('Crud/Index', [
            'columns' => [
                'id', 'name', 'email', 'roles_string', 'created_at'
            ],
            'headings' => [
                'ID', 'Name', 'E-Mail', 'Roles', 'Created at'
            ],
            'crud' => [
                'source' => User::all(),
                'name' => 'Users',
                'back' => 'admin.index',
                'show' => 'admin.user.show',
            ]
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Admin/User/Show', [
            'userItem' => $user,
            'roles' => Role::all()->values(),
            'permissions' => Permission::all()->values(),
        ]);
    }

    public function update(User $user)
    {
        $user->update(request()->all());

        $user->syncRoles(request('roles'));
        $user->syncPermissions(request('permissions'));

        return request()->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'User updated.');
    }

}
