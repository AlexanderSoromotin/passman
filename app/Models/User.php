<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'full_name',
        'resources_number',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function resources()
    {
        return $this->hasMany(UserResource::class, 'user_id');
    }

    public function getResourcesNumberAttribute()
    {
        return $this->resources->count();
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->patronymic}";
    }

    public static function getUserById($id)
    {
        return self::find($id);
    }

    public static function getUserByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    public function updateUser($data)
    {
        return $this->update($data);
    }

    public function deleteUser()
    {
        return $this->delete();
    }

    public static function createUser($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return self::firstOrCreate([
            'email' => $data['email']
        ], $data);
    }

    public static function getAll($request = null) {
        if (!$request) {
            return self::all();
        }

        $query = self::query();

        // Фильтр по роли
        if ($request->has('role_id')) {
            $query->where('role_id', $request->input('role_id'));
        }

        return $query->paginate($request->input('per_page', 20));
    }

    public function changePassword($password)
    {
        $this->update([
            'password' => Hash::make($password)
        ]);
    }
}
