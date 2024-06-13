<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'resource_id',
        'description',
        'senior_specialist_id',
        'head_specialist_id',
        'status',
    ];

    public function seniorSpecialist()
    {
        return $this->belongsTo(User::class, 'senior_specialist_id');
    }

    public function headSpecialist()
    {
        return $this->belongsTo(User::class, 'head_specialist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public static function getAll($request) {
        return self::all();
    }

    public static function createRequest($data)
    {
        $data['status'] = 'Заявка ожидает подтверждения';
        return self::firstOrCreate([
            'user_id' => $data['user_id'],
            'resource_id' => $data['resource_id'],
        ], $data);
    }

    public static function getRequestById($id)
    {
        return self::find($id);
    }

}
