<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\SaveRequest;
use App\Http\Resources\TodoResource;
use App\Http\Services\TodoService;

class TodoController extends Controller
{
    /**
     * @param TodoService $todoService
     * @return TodoResource
     */
    public function index(TodoService $todoService)
    {
        return new TodoResource($todoService->listTodo());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaveRequest $request, TodoService $todoService)
    {
        try{
            $todo = $todoService->saveTodo($request->toArray());

            return $this->sendJsonSuccessResponse('Todo added successfully', $todo->only('id','name','description','status'));
        } catch(\Exception $ex) {

            return $this->sendJsonErrorResponse('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, TodoService $todoService)
    {
        try{
            $todo = $todoService->getTodo($id);
            if($todo)
                return $this->sendJsonSuccessResponse('Success', $todo);

            return $this->sendJsonErrorResponse('Not found!');

        } catch(\Exception $ex) {

            return $this->sendJsonErrorResponse('Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SaveRequest $request, $id, TodoService $todoService)
    {
        try{
            $request->merge(['id' => $id]);
            $todoId = $todoService->saveTodo($request->toArray());

            return $this->sendJsonSuccessResponse('Todo updated successfully!', $todoId->toArray());
        } catch(\Exception $ex) {
            return $this->sendJsonErrorResponse('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $todo, TodoService $todoService)
    {
        try {
            $deletedStatus = $todoService->deleteTodo($todo);
            if ($deletedStatus)
                return $this->sendJsonSuccessResponse('Todo deleted successfully!');

            return $this->sendJsonErrorResponse('Data not found');
        } catch (\Exception $ex) {
            return $this->sendJsonErrorResponse('Something went wrong');
        }
    }
}
