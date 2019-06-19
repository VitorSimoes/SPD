<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['id', 'id_user', 'id_category', 'value', 'type', 'date', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
