<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'description', 'image', 'created_at', 'updated_at'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
