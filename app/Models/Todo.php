<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = ['title', 'completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
