<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\User; // 追加

use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->get();
            
            return view('tasks.index', [
                'tasks' => $tasks,
            ]);
            
        }
        
        return view('welcome', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Task = new Task;

        return view('tasks.create', [
            'Task' => $Task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:191',
        ]);
        
        $Task = new Task;
        $Task->user_id = Auth::user()->id;
        $Task->status = $request->status;    // 追加
        $Task->content = $request->content;
        $Task->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Task = optional(Task::find($id));

        if (\Auth::id() === ($Task->user_id)) {
            return view('tasks.show', [
                'Task' => $Task,]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Task = Task::find($id);

        if (\Auth::id() === $Task->user_id) {
            return view('tasks.edit', [
                'Task' => $Task,]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:191',
        ]);
        
        $Task = Task::find($id);
        $Task->status = $request->status;    // 追加
        $Task->content = $request->content;
        $Task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Task = Task::find($id);
        
        if (\Auth::id() === $Task->user_id) {
            $Task->delete();
        }
        
        return redirect('/');
        
    }
}
