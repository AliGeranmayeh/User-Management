<?php

namespace App\Http\Controllers;

use App\Helpers\DB\TaskRepository;
use App\Helpers\Response\TaskResponse;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use TaskResponse;

    public function index(IndexTaskRequest $request)
    {
        $tasks = $this->handleIndexData($request);

        return $this->indexResponse($tasks);
    }

    public function show(Task $task)
    {
        return $this->showResponse($task);
    }

    public function store(CreateTaskRequest $request)
    {
        $task = TaskRepository::create($request);
        return $this->storeResponse($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        [$task, $isUpdatedFlag] = TaskRepository::update($task, $request->validated());
        return $this->updateResponse($task, $isUpdatedFlag);
    }

    public function destroy(Task $task)
    {
        $isDeleted = TaskRepository::delete($task);

        $this->destroyResponse($isDeleted);
    }

    private function handleIndexData($data)
    {
        return TaskRepository::search($data->paginate, $data->status ?? null);
    }
}
