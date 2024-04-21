<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $receptionistPermissions = [
            'view_appointments',
            'change_appointment',
        ];
        
        $doctorPermissions = [
            'view_patient',
            'add_patient',
            'give_referrals',
            'set_appointments',
            'use_recommendation_system',
            
        ];
        
        
        $adminPermissions = array_merge(
            [
                'generate_reports',
                'manage_users',
                'manage_health_centers',
                'update_center',
                'create_users',
                'view_users',
            ],
            $receptionistPermissions,
            $doctorPermissions
        );
        $superadminPermissions = array_merge(
            [
                'manage_admins',
                'view_all_data',
                'manage_system_settings',
                'access_audit_logs',
                'manage_permissions',
                'full_system_control',
            ],
            $adminPermissions
        );

      
        $allPermissions = array_unique(
            array_merge($receptionistPermissions, $doctorPermissions, $adminPermissions, $superadminPermissions)
        );

        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
      
        $receptionistRole = Role::create(['name' => 'staff']);
        $receptionistRole->givePermissionTo($receptionistPermissions);

        $doctorRole = Role::create(['name' => 'doctor']);
        $doctorRole->givePermissionTo($doctorPermissions);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($adminPermissions);

        $superadminRole = Role::create(['name' => 'superadmin']);
        $superadminRole->givePermissionTo($superadminPermissions);
      
        
    }
}
