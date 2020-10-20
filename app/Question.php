<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = 'questions';
    protected $fillable = [
        'id',
        'question_image_url',
        'correct_answer',
        'solution_image_url',
//        'subject',      // 과목
//        'test_year',
//        'test_month',
        'source_of_question',
        'question_number',
        'part1',
        'part2',
        'part3',
        'score',
        'type',         // 0이면 주관식, 1이면 객관식
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function trials() {
        return $this->hasMany('App\Trial', 'question_id');
    }
}
