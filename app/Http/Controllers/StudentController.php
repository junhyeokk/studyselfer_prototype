<?php

namespace App\Http\Controllers;

use App\Question;
use App\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectSubject() {
        return view('select_subject');
    }

    public function selectTest($subject) {
        $rows = Question::where('subject', $subject)->select('source_of_question')->distinct()->get();
        return view('select_test', ['rows' => $rows, 'subject' => $subject]);
    }

    public function solveQuestion($subject, $test, $question) {
        $row = Question::where('subject', $subject)->where('source_of_question', $test)->where('question_number', $question)->first();
        return view('solve_question', ['row' => $row]);
    }

    public function tryTest($subject, $test, $time) {
        $rows = Question::where('subject', $subject)->where('source_of_question', $test)->get();
        return view('try_test', ['rows' => $rows, 'time' => $time]);
    }

    public function testResult(Request $request, $subject, $test) {
        $aa = "done";

        foreach ($request->input() as $question_no => $question) {
            $question_info = Question::where('subject', $subject)->where('source_of_question', $test)->where('question_number', $question_no)->first();

            $new_trial = new Trial;
            $new_trial->question_id = $question_info->id;
            $new_trial->user_id = Auth::id();
            $new_trial->option1 = $question['option1'];
            $new_trial->option2 = $question['option2'];
            $new_trial->option3= $question['option3'];
            $new_trial->option4 = $question['option4'];
            $new_trial->option5 = $question['option5'];
            $new_trial->time_taken = $question['time_taken'];
            $new_trial->choice = $question['choice'];

            if ($question['choice'] == $question_info->correct_answer) {
                $new_trial->is_correct = true;
            } else {
                $new_trial->is_correct = false;
            }

            // nth trial
            $nth_trial = 1;
            $last_trial = Trial::where('user_id', $new_trial->user_id)->where('question_id', $question_info->id)->latest('created_at')->first();
            if (!empty($last_trial)) {
                $nth_trial = $last_trial->nth_trial + 1;
            }
            $new_trial->nth_trial = $nth_trial;

            // test mode
            $new_trial->test_mode = $question['test_mode'];

            $new_trial->save();
        }

        return $aa;
    }
}
