<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

use App\Models\Task;
use App\Models\Statistic;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id','desc')->get();

        return view('admin.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_admin',0)->orderBy('id','desc')->get();
        $admins = User::where('is_admin',1)->orderBy('id','desc')->get();

        return view('admin.task.create',compact('users','admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'assigned_to_id' => 'required|exists:users,id',
            'assigned_by_id' => 'required|exists:users,id',
        ]);

        $input = $request->all();

        //Create Task
        Task::create($input);

        //Create OR Update Tasks Count in Statistic
        $statistic = Statistic::where('user_id', $input['assigned_to_id'])->first();

        if($statistic != null)
        {
            $statistic->count = ++$statistic->count ;
            $statistic->update();
        } else {
            Statistic::create([
                'user_id' => $input['assigned_to_id'],
                'count' => 1
            ]);
        }
        
        Session::flash('success','تم إضافة مهمة بنجاح');
        return redirect()->route('task.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
