<?php


namespace App\Http\Services;



use App\Models\Todo;

class TodoService
{
    /**
     * @return mixed
     */
    public function listTodo()
    {
        return Todo::select('id', 'name', 'description','status')->get();
    }
    /**
     * @param array $userData
     * @return array
     */
    public function saveTodo(array $todoData)
    {
        if(isset($todoData['id'])){
            $todo = Todo::find($todoData['id']);
            $todo->update($todoData);
        } else {
            $todo = new Todo();
            $todo = $todo->create($todoData);
        }
        return $todo;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTodo(int $id)
    {
        $todo = Todo::find($id);
        if($todo) {
            $todo->delete();
            return true;
        }
         return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTodo(int $id)
    {
        $todo = Todo::find($id)->only('id','name','description','status');

        return $todo;
    }
}