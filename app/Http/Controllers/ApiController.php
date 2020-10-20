<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function getQuestion(Request $request) {
        $row = Question::inRandomOrder()->first();

        $return_value = [
            "question_id" => $row->id,
            "question_number" => $row->question_number,
            "question_image_url" => $row->question_image_url,
            "solution_image_url" => $row->solution_image_url,
            "source_of_question" => $row->source_of_question,
        ];

//        return json_encode($return_value);
    }

    public function getMetaData(Request $request, $question_id) {
        $row = Question::where("id", $question_id)->first();

        $return_value = [
            "number" => $row->question_number,
            "part1" => $row->part1,
            "part2" => $row->part2,
            "part3" => $row->part3,
            "answer" => $row->correct_answer,
            "score" => $row->score
        ];

        return json_encode($return_value);
    }

    public function tryTest(Request $request, $test) {
        $rows = Question::where("source_of_question", $test)->get();

        $return_value = array();
        foreach ($rows as $row) {
            $return_value[$row->question_number] = array();

            $return_value[$row->question_number]["questId"] = $row->id;
            $return_value[$row->question_number]["questImageUrl"] = $row->question_image_url;
        }

        return json_encode($return_value);
    }

    public function answers(Request $request, $test) {
        $rows = Question::where("source_of_question", $test)->get();

        $return_value = array();
        $return_value["correctAns"] = array();
        $return_value["questId"] = array();
        foreach ($rows as $row) {
            $return_value["questId"][$row->question_number] = $row->id;
            $return_value["correctAns"][$row->question_number] = $row->correct_answer;
        }

        return json_encode($return_value);
    }

    public function solutions(Request $request, $test) {
        $rows = Question::where("source_of_question", $test)->get();

        $return_value = array();
        $return_value["solutionImageUrl"] = array();
        $return_value["questId"] = array();
        foreach ($rows as $row) {
            $return_value["questId"][$row->question_number] = $row->id;
            $return_value["solutionImageUrl"][$row->question_number] = $row->solution_image_url;
        }

        return json_encode($return_value);
    }

    public function diagnoseChapter(Request $request) {
        Log::info("chapter data");
        Log::info($request);

        $row = Question::inRandomOrder()->first();

        $return_value = array();
        $return_value["type"] = $row->type == 1 ? true : false;
        $return_value["questionImageUrl"] = $row->question_image_url;
        $return_value["solutionImageUrl"] = $row->solution_image_url;

        return json_encode($return_value);
    }

    public function diagnoseAnswer(Request $request) {
        Log::info("answer data");
        Log::info($request);

        $random = rand(1, 10);
        $return_value = array();

        if ($random == 3) {
            $return_value = "diagnose finished";
        } else {
            $row = Question::inRandomOrder()->first();

            $return_value["type"] = $row->type == 1 ? true : false;
            $return_value["questionImageUrl"] = $row->question_image_url;
            $return_value["solutionImageUrl"] = $row->solution_image_url;
        }
        return json_encode($return_value);
    }
}
