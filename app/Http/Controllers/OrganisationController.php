<?php


namespace App\Http\Controllers;


use App\Http\Requests\Organisation\OrganisationStoreRequest;
use App\Models\Organisation;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

class OrganisationController extends Controller
{

    public function show()
    {
        return Inertia::render('Organisation/Index', [
            'organisations' => auth()->user()->organisations
        ]);
    }

    public function store(OrganisationStoreRequest $request)
    {
        if (auth()->user()->organisations()->pending()->count() >= 1)
            return request()->wantsJson()
                ? new JsonResponse('', 200)
                : back()->withErrors(['message' => 'Another upcoming audits of their organizations are still pending.']);

        auth()->user()->organisations()->create($request->validated());
        return request()->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'Organisation created.');
    }

    public function destroy(Organisation $organisation)
    {
        auth()->user()->organisations()->findOrFail($organisation->id);
        $organisation->delete();
        return request()->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'Organization deleted.');
    }

}
