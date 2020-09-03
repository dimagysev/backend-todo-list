<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos()
            ->orderByDesc('created_at')
            ->get()
        );
    }

    public function store(TodoStoreRequest $request)
    {
        $todo = auth()->user()->todos()->create($request->validated());
        return new TodoResource($todo);
    }

    public function update(TodoUpdateRequest $request, Todo $todo)
    {
        if (auth()->id() === $todo->user_id){
            if ($todo->update($request->validated())){
                return new TodoResource($todo);
            }
        }
        return response()->json(['error' => 'Something went wrong'], 500);
    }

    public function changeStatusAll(Request $request)
    {
        $status = $request->all();
        $todos = auth()->user()->todos()->orderByDesc('created_at')->get();
        $todos->each(function ($item) use($status) {
            $item->update($status);
        });
        return TodoResource::collection($todos);
    }

    public function destroy(Todo $todo)
    {
        if (auth()->id() === $todo->user_id){
            if($todo->delete()){
                return response()->json(['id' => $todo->id]);
            }
        }
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}
