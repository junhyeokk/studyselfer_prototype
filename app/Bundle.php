<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bundle extends Model
{
    use SoftDeletes;
    protected $table = 'bundles';
    protected $fillable = [
        'name',
        'question_id'
    ];

    public function questions() {
        return $this->hasMany('App\Question', 'question_id');
    }
}
