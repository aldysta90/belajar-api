<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:permissions.index']);
    }

    /**
     * function index
     *
     * @return void
     */
    public function index()
    {
        $permissions = Permission::latest()->when(request()->q, function ($permissions) {
            $permissions = $permissions->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);

        return view('admin.permission.index', compact('permissions'));
    }
}
