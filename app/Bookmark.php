<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model
{
    use SoftDeletes;
    protected $table = 'bookmarks';
    protected $fillable = [
        'question_id',
        'user_id'
    ];

    public function question() {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
