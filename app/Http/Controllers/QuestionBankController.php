<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use App\Helpers\DB\QuestionRepository;
use App\Http\Requests\Question\CreateQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Helpers\Response\QuestionResponse;

class QuestionBankController extends Controller
{
    use QuestionResponse;
    public function index()
    {
        $questions = QuestionRepository::allWithPagination();

        return $this->indexResponse($questions);
    }

    public function store(CreateQuestionRequest $request)
    {
        $question = QuestionRepository::create($request);

        return $this->storeResponse($question);
    }
    public function show(QuestionBank $question)
    {
        return $this->showResponse($question);
    }

    public function destroy(QuestionBank $question)
    {
        $isDeleted = QuestionRepository::delete($question);

        $this->destroyResponse($isDeleted);
    }

    public function update(UpdateQuestionRequest $request, QuestionBank $question)
    {
        [$question, $isUpdated] = QuestionRepository::update($question,$request->validated());

        return $this->updateResponse($question, $isUpdated);
    }
}
