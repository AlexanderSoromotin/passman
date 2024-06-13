<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'content',
        'is_group',
        'group_id',
        'login',
        'password',
        'expiration_at',
    ];

    protected $casts = [
        'is_group' => 'boolean',
        'group_id' => 'integer',
    ];

    protected $appends = [
        'expiration_in',
    ];

//    // Аксессор для расшифровки атрибута 'password'
    public function getPasswordAttribute($value)
    {
        return Crypt::decrypt($value);
    }
//
    // Мутатор для шифрования атрибута 'password'
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encrypt($value);
    }

    public function webhook()
    {
        return $this->belongsTo(Webhook::class, 'id', 'resource_id');
    }

    public function users()
    {
        return $this->hasMany(UserResource::class, 'resource_id');
    }

    public function getExpirationInAttribute()
    {
        if ($this->expiration_at == null) {
            return 'Неограниченно';
        }

        return "Истекает через " . Carbon::createFromFormat('Y-m-d H:i:s', $this->expiration_at)->startOfDay()->diffInDays(Carbon::now()) . " дн";
    }

    public static function getAll($request)
    {
        $query = self::query();

        if ($request->has('is_group')) {
            $query->where('is_group', $request->is_group)->where('group_id', null);
        }

        if ($request->has('group_id')) {
            $query->where('group_id', $request->group_id);
        } else {
            $query->where('group_id', null)->orderBy('is_group', 'desc');
        }

        return $query->get();
    }

    public static function createResource($data)
    {
        $resource = self::firstOrCreate($data);
        Webhook::firstOrCreate([
            'resource_id' => $resource->id
        ]);

        return $resource;
    }

    public static function getResourceById($id)
    {
        return self::find($id);
    }

    public function updateResource($data)
    {
        return $this->update($data);
    }

    public function deleteResource()
    {
        return $this->delete();
    }
}
