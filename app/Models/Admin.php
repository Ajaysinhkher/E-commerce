<?php

namespace App\Models;
use App\Models\Role;    
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins'; // Specify the table name

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'status', // Include status in fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    // super admin function
    public function isSuperAdmin() {
        // Assuming Super Admin has role_id = 1
        return $this->role_id === 6;
    }


    public function hasPermission($permission) {
        Log::info("Checking permission test for admin ID: {$this->id}");
    
        if ($this->isSuperAdmin()) {
            Log::info("Admin ID: {$this->id} is a Super Admin. Access granted.");
            return true;
        }
    
        $hasPermission = $this->role()->whereHas("permissions", function ($query) use ($permission) {
            Log::info("inside haspermission");
            $query->where("slug", $permission);
        })->exists();

        
    
        Log::info("Permission '{$permission}' check for admin ID: {$this->id} returned: " . ($hasPermission ? 'Allowed' : 'Denied'));
    
        return $hasPermission;
    }
}
