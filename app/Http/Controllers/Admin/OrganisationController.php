<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OrganisationController extends Controller
{

    public function index()
    {
        return Inertia::render('Crud/Index', [
            'columns' => [
                'id', 'name', 'state', 'legal', 'created_at'
            ],
            'headings' => [
                'ID', 'Name', 'State', 'Legal', 'Created at'
            ],
            'crud' => [
                'source' => Organisation::all(),
                'name' => 'Organizations',
                'back' => 'admin.index',
                'show' => 'admin.organisation.show',
            ]
        ]);
    }

    public function show(Organisation $organisation)
    {
        return Inertia::render('Crud/Show', [
            'crud' => [
                'title' => 'Organization',
                'description' => 'Update organization\'s informations',
                'source' => $organisation,
                'updateUrl' => 'admin.organisation.update',
            ]
        ]);
    }

    public function update(Organisation $organisation)
    {
        $organisation->update(request()->all());

        return request()->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'Organization updated.');
    }

}
