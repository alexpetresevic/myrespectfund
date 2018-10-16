<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{

    public function index()
    {
        $items = Organization::paginate(10);

        return view('admin.organisation.index', compact('items'));
    }


    public function create()
    {
        return view('admin.organisation.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name"           => "required|unique:organizations",
            "url"            => "required|url|unique:organizations",
            "url_new_window" => "required|boolean",
        ]);

        $organization = Organization::create($data);

        if ($request->has('image')) {
            File::saveFileToModel($request, $organization, 'uploads/organisations/', 'org');
        }

        return redirect()->route('admin.organization.index')->with('status', ['type' => 'success', 'message' => 'Organization created successfully.']);
    }

    public function show(Organization $organization)
    {
        //
    }

    public function edit(Organization $organisation)
    {
        return view('admin.organisation.edit', compact('organisation'));
    }

    public function update(Request $request, Organization $organisation)
    {
        $data = $request->validate([
            'name'           => 'required|unique:organizations,name,' . $organisation->id,
            'url'            => 'required|url|unique:organizations,url,' . $organisation->id,
            'url_new_window' => 'required|boolean',
        ]);

        $organisation->update($data);

        if ($request->has('image')) {
            File::saveFileToModel($request, $organisation, 'uploads/organisations/', 'org');
        }

        return redirect()->route('admin.organization.index')->with('status', ['type' => 'success', 'message' => 'Organization updated successfully.']);
    }

    public function destroy(Organization $organisation)
    {
        $organisation->delete();

        return redirect()->route('admin.organization.index')->with('status', ['type' => 'success', 'message' => 'Organization deleted successfully.']);
    }
}
