<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'user_status';

    public $timestamps = false;

    public function users() {
        return $this->hasMany(User::class, 'estatus', 'id');
    }
}
