<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function hasRole($role)
    {
        return $this->staff && $this->staff->position === $role;
    }
    public function isManager()
    {
        return $this->hasRole('Manager');
    }
    public function isSupervisor()
    {
        return $this->hasRole('Supervisor');
    }
    public function isSecretary()
    {
        return $this->hasRole('Secretary');
    }
    public function isRegularStaff()
    {
        return $this->hasRole('Regular staff');
    }

    public function getRoleAttribute()
    {
        if (!$this->staff) {
            return 'user';
        }
        
        $pos = strtolower($this->staff->position);
        if ($pos === 'regular staff') {
            return 'staff';
        }
        return $pos;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
