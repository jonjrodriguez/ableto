<?php

namespace AbleTo\Http\Controllers\Api;

use AbleTo\Http\Controllers\Controller;
use AbleTo\Http\Resources\Question as QuestionResource;
use AbleTo\Question;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all questions with their options
     *
     * @return mixed
     */
    public function index()
    {
        return QuestionResource::collection(Question::with('options')->get());
    }
}
