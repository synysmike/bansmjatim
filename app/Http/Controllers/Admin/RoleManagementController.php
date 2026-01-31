<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Yajra\DataTables\DataTables;

class RoleManagementController extends Controller
{
    /**
     * Display the role management dashboard.
     */
    public function index()
    {
        $tittle = 'Role & User Management';
        $user = Auth::user();

        $usersCount = User::count();
        $rolesCount = Role::count();
        $permissionsCount = Permission::count();

        return view('admin.role-management.index', compact('tittle', 'user', 'usersCount', 'rolesCount', 'permissionsCount'));
    }

    // ==================== USER MANAGEMENT ====================

    /**
     * Display a listing of users.
     */
    public function users(Request $request)
    {
        $tittle = 'User Management';
        $user = Auth::user();

        if ($request->ajax()) {
            $users = User::with('roles')->select('users.*');

            if ($request->filled('role_id')) {
                $users->whereHas('roles', function ($q) use ($request) {
                    $q->where('roles.id', $request->role_id);
                });
            }

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->getRoleNames()->map(function ($role) {
                        return '<span class="badge badge-primary">' . $role . '</span>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($user) {
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<button type="button" onclick="editUser(' . $user->id . ')" class="text-left"><i class="fas fa-edit admin-icon"></i> Edit</button>';
                    $html .= '<button type="button" onclick="deleteUser(' . $user->id . ')" class="text-left text-red-600"><i class="fas fa-trash admin-icon"></i> Delete</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }

        $roles = Role::orderBy('name')->get(['id', 'name']);
        return view('admin.role-management.users', compact('tittle', 'user', 'roles'));
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $roleId = $request->input('jabatan_role_id');
        $validator = Validator::make(
            array_merge($request->all(), ['jabatan_role_id' => $roleId]),
            [
                'username' => 'required|string|max:255|unique:users,username',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'jabatan_role_id' => 'required|exists:roles,id',
                'kab_kota' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
            ],
            ['jabatan_role_id.required' => 'Please select a Jabatan (Role).', 'jabatan_role_id.exists' => 'The selected Jabatan (Role) is invalid.']
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'kab_kota' => $request->kab_kota,
                'jabatan' => $request->jabatan,
            ]);

            $role = Role::findOrFail($roleId);
            $user->assignRole($role);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user data for editing.
     */
    public function getUser($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'kab_kota' => $user->kab_kota,
                'jabatan' => $user->jabatan,
                'role_id' => $user->roles->first() ? $user->roles->first()->id : null,
            ]
        ]);
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roleId = $request->input('jabatan_role_id');

        $validator = Validator::make(
            array_merge($request->all(), ['jabatan_role_id' => $roleId]),
            [
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'name' => 'required|string|max:255',
                'password' => 'nullable|string|min:6',
                'jabatan_role_id' => 'required|exists:roles,id',
                'kab_kota' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
            ],
            ['jabatan_role_id.required' => 'Please select a Jabatan (Role).', 'jabatan_role_id.exists' => 'The selected Jabatan (Role) is invalid.']
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $updateData = [
                'username' => $request->username,
                'name' => $request->name,
                'kab_kota' => $request->kab_kota,
                'jabatan' => $request->filled('jabatan') ? $request->jabatan : $user->jabatan,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            // Update role
            $role = Role::findOrFail($roleId);
            $user->syncRoles([$role]);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified user.
     */
    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting yourself
            if ($user->id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot delete your own account!'
                ], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }

    // ==================== ROLE MANAGEMENT ====================

    /**
     * Display a listing of roles.
     */
    public function roles(Request $request)
    {
        $tittle = 'Role Management';
        $user = Auth::user();

        if ($request->ajax()) {
            $roles = Role::with('permissions')->select('*');

            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('permissions', function ($role) {
                    return $role->permissions->map(function ($permission) {
                        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-admin-info bg-opacity-20 text-admin-info">' . e($permission->name) . '</span>';
                    })->implode(' ');
                })
                ->addColumn('users_count', function ($role) {
                    return $role->users()->count();
                })
                ->addColumn('action', function ($role) {
                    $roleId = isset($role->id) ? (int) $role->id : 0;
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<button type="button" onclick="editRole(' . $roleId . ')" class="text-left"><i class="fas fa-edit admin-icon"></i> Edit</button>';
                    $html .= '<button type="button" onclick="managePermissions(' . $roleId . ')" class="text-left"><i class="fas fa-key admin-icon"></i> Permissions</button>';
                    $html .= '<button type="button" onclick="deleteRole(' . $roleId . ')" class="text-left text-red-600"><i class="fas fa-trash admin-icon"></i> Delete</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        $permissions = Permission::all();
        return view('admin.role-management.roles', compact('tittle', 'user', 'permissions'));
    }

    /**
     * Store a newly created role.
     */
    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            // Assign permissions if provided
            if ($request->has('permissions') && is_array($request->permissions)) {
                $permissions = Permission::whereIn('id', $request->permissions)->get();
                $role->syncPermissions($permissions);
            }

            // Clear permission cache
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            return response()->json([
                'success' => true,
                'message' => 'Role created successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get role data for editing.
     */
    public function getRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissionIds = $role->permissions->pluck('id')->map(function ($id) {
            return (int) $id;
        })->values()->toArray();

        return response()->json([
            'success' => true,
            'role' => [
                'id' => (int) $role->id,
                'name' => $role->name ?? '',
                'permission_ids' => $permissionIds,
            ]
        ]);
    }

    /**
     * Update the specified role.
     */
    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $role->update([
                'name' => $request->input('name'),
            ]);

            // Update permissions: use request permissions or empty array
            $permissionIds = $request->has('permissions') && is_array($request->permissions)
                ? $request->permissions
                : [];
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role->syncPermissions($permissions);

            // Clear permission cache
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified role.
     */
    public function destroyRole($id)
    {
        if ($id === null || $id === '' || $id === 'undefined' || !is_numeric($id) || (int) $id < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid role ID.',
            ], 400);
        }

        $id = (int) $id;

        try {
            $role = Role::findOrFail($id);

            // Prevent deleting admin role
            if ($role->name === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete the admin role!'
                ], 403);
            }

            $role->delete();

            // Clear permission cache
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete role: ' . $e->getMessage()
            ], 500);
        }
    }

    // ==================== PERMISSION MANAGEMENT ====================

    /**
     * Display a listing of permissions.
     */
    public function permissions(Request $request)
    {
        $tittle = 'Permission Management';
        $user = Auth::user();

        if ($request->ajax()) {
            $permissions = Permission::with('roles')->select('id', 'name', 'guard_name', 'created_at', 'updated_at');

            return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn('roles', function ($permission) {
                    return $permission->roles->map(function ($role) {
                        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-admin-primary bg-opacity-20 text-admin-primary">' . e($role->name) . '</span>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($permission) {
                    if (!$permission->id) {
                        return '<span class="text-admin-text-secondary text-sm">—</span>';
                    }
                    $html = '<div class="action-dropdown">';
                    $html .= '<button type="button" class="action-dropdown-toggle" aria-haspopup="true"><span>Actions</span><i class="fas fa-chevron-down admin-icon-sm"></i></button>';
                    $html .= '<div class="action-dropdown-menu hidden">';
                    $html .= '<button type="button" onclick="deletePermission(' . $permission->id . ')" class="text-left text-red-600"><i class="fas fa-trash admin-icon"></i> Delete</button>';
                    $html .= '</div></div>';
                    return $html;
                })
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }

        return view('admin.role-management.permissions', compact('tittle', 'user'));
    }

    /**
     * Store a newly created permission.
     */
    public function storePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Check if permission with same name and guard already exists
            $existing = Permission::where('name', $request->name)
                ->where('guard_name', 'web')
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission already exists!'
                ], 422);
            }

            // Check table structure first
            try {
                $tableInfo = DB::select("SHOW COLUMNS FROM permissions WHERE Field = 'id'");
                if (empty($tableInfo)) {
                    throw new \Exception('ID column not found in permissions table.');
                }

                $idColumn = $tableInfo[0];
                $isAutoIncrement = strpos($idColumn->Extra, 'auto_increment') !== false;

                if (!$isAutoIncrement) {
                    // Try to fix the table structure
                    try {
                        DB::statement("ALTER TABLE permissions MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
                        Log::info('Fixed permissions table: Set id as AUTO_INCREMENT');
                    } catch (\Exception $alterError) {
                        Log::error('Failed to fix table structure: ' . $alterError->getMessage());
                        return response()->json([
                            'success' => false,
                            'message' => 'Database table structure issue. The id column is not set as AUTO_INCREMENT. Please run: ALTER TABLE permissions MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;'
                        ], 500);
                    }
                }
            } catch (\Exception $checkError) {
                Log::warning('Could not check table structure: ' . $checkError->getMessage());
            }

            // Use DB transaction to ensure data integrity
            DB::beginTransaction();

            try {
                // Try using Eloquent first (simpler)
                try {
                    $permission = Permission::create([
                        'name' => $request->name,
                        'guard_name' => 'web'
                    ]);

                    if (!$permission->id) {
                        throw new \Exception('Permission created but ID was not assigned.');
                    }
                } catch (\Exception $eloquentError) {
                    // If Eloquent fails, try raw SQL
                    if (strpos($eloquentError->getMessage(), "doesn't have a default value") !== false) {
                        // Use raw SQL insert without specifying id
                        $now = now();
                        DB::statement("INSERT INTO permissions (name, guard_name, created_at, updated_at) VALUES (?, ?, ?, ?)", [
                            $request->name,
                            'web',
                            $now,
                            $now
                        ]);

                        // Get the last insert ID
                        $insertId = DB::getPdo()->lastInsertId();

                        if (!$insertId) {
                            // Try to find it by name
                            $permission = Permission::where('name', $request->name)
                                ->where('guard_name', 'web')
                                ->orderBy('created_at', 'desc')
                                ->first();

                            if (!$permission) {
                                throw new \Exception('Permission was inserted but could not be retrieved.');
                            }
                        } else {
                            $permission = Permission::find($insertId);
                            if (!$permission) {
                                throw new \Exception('Permission was created but could not be retrieved from database.');
                            }
                        }
                    } else {
                        throw $eloquentError;
                    }
                }

                DB::commit();

                // Clear permission cache
                app()[PermissionRegistrar::class]->forgetCachedPermissions();

                Log::info('Permission created successfully', [
                    'id' => $permission->id,
                    'name' => $permission->name
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Permission created successfully!',
                    'permission' => [
                        'id' => $permission->id,
                        'name' => $permission->name
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Permission creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified permission.
     */
    public function destroyPermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            // Clear permission cache
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all available permissions.
     */
    public function getAllPermissions()
    {
        $permissions = Permission::all();

        return response()->json([
            'success' => true,
            'permissions' => $permissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            })
        ]);
    }
}
