<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //index
    public function index(Request $request)
    {
        $permissions = Permission::with('user')->when($request->input('name'), function ($query, $name) {
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', "%$name%");
            });
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.permissions.index', compact('permissions'));
    }

    //show
    public function show(Permission $permission)
    {
        return view('pages.permissions.show', compact('permission'));
    }

    //edit
    public function edit(Permission $permission)
    {
        return view('pages.permissions.edit', compact('permission'));
    }

    //update
    public function update(Request $request, Permission $permission)
    {
        // $permission = Permission::find($id);
        // $permission->is_approved = $request->is_approved;
        // $permission->save();
        // return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        $request->validate([
            'is_approved' => 'required',
        ]);
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }
}
