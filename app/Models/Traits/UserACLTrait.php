<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions()
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $permission) {
            if (in_array($permission, $permissionsPlan))
                array_push($permissions, $permission);
        }

        return $permissions;

        $permissions = [];

        $tenant = $this->tenant()->first();
        $plan = $this->tenant->plan;

        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }

        }
       return $permissions;

    }
    //
    //Permissões do Plano
     public function permissionsPlan(): array
    {
        // $tenant = $this->tenant;
        // $plan = $tenant->plan;
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }
    //
    //Permissões do Cargo
    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }
    //
    //  Testa se o usuário permissão
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }
    //
    // Testa se o usuário é admin
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }
    //
    //
    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }








}
