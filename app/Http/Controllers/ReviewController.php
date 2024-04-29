<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Helpers\DB\ReviewRepository;
use App\Helpers\DB\TaskRepository;
use App\Http\Requests\Review\CreateReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Helpers\Response\ReviewResponse;
use App\Http\Requests\Review\IndexReviewRequest;

class ReviewController extends Controller
{
    use ReviewResponse;


    public function index(IndexReviewRequest $request)
    {
        $users = TaskRepository::allWithPagination($request->paginate);

        return $this->indexResponse($users);
    }
    public function show(Review $review)
    {
        return $this->showResponse($review);
    }

    public function store(CreateReviewRequest $request)
    {
        $review = ReviewRepository::create($request);
        return $this->storeResponse($review);
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        [$review, $isUpdatedFlag] = ReviewRepository::update($review, $request->validated());
        return $this->updateResponse($review, $isUpdatedFlag);
    }

    public function destroy(Review $review)
    {
        $isDeleted = ReviewRepository::delete($review);

        $this->destroyResponse($isDeleted);
    }
}
