<?php

namespace AbleTo\Http\Controllers\Api;

use AbleTo\Answer;
use AbleTo\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all of the current users answers group by date
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(['data' => Answer::forUser(auth()->user())]);
    }

    /**
     * Store the answers for the current user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answers = $request->validate([
            '*.question_id' => 'required|exists:questions,id',
            '*.option_id' => 'required|exists:options,id'
        ]);

        return response(['data' => auth()->user()->answers()->createMany($answers['*'])], 201);
    }

    /**
     * Get the answers for the current user by the given date.
     *
     * @param $date
     * @return void
     */
    public function show($date)
    {
        try {
            $date = Carbon::parse($date);
        } catch (\Exception $ex) {
            return response(['error' => $ex->getMessage()], 422);
        }

        return response(['data' => Answer::byDate(auth()->user(), $date)]);
    }
}
