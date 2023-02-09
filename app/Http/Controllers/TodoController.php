<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::get();
        foreach ($todo as $x) {
            $x->note = explode("\n", $x->note);
        }
        return view('container.landing')->with('todo', $todo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('container.add-todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];
        
        Validator::make($request->all(), $rules, $messages = $this->messages)->validate();
        
        Todo::create([
            'title' => $request->title,
            'note' => $request->note,
            'date' => $request->date,
            'time' => $request->time,
            'place' => $request->place,
            'checklist' => false,
        ]);
        
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('container.edit-todo')->with('todo', $todo);
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
        if($request->checklist) {
            $checklist = true;
        } else {
            $checklist = false;
        }

        $todo = Todo::find($id);

        if(!$request->title) {
            $todo->update([
                'checklist' => $checklist,
            ]);
        } else {
            $todo->update([
                'title' => $request->title,
                'note' => $request->note,
                'date' => $request->date,
                'time' => $request->time,
                'place' => $request->place,
                'checklist' => $checklist,
            ]);
        }

        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}
