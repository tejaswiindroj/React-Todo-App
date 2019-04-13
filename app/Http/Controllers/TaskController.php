<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use DB;

class TaskController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index(Request $request, Task $task) {
		// get all the tasks based on current user id
		$allTasks = $task->whereIn('user_id', $request->user())->with('user');
		$tasks = $allTasks->orderBy('created_at', 'desc')->take(20)->get();
		// return json response
		return response()->json([
			'tasks' => $tasks,
        ]);
        // $data = new \App\SearchData();
        // $data->name=$request->get('name');
		// $data->save();
		$tasks = DB::table('tasks')->where('name', 'like', '%'.$search.'%')->paginate();
        return view('home',['tasks'=>$tasks]);
	}

	public function create() {
         return view('home');
	}
    public function search(Request $request){
        $search = $request->get('search');
        $tasks = DB::table('tasks')->where('name', 'like', '%'.$search.'%')->paginate();
        return view('home',['tasks'=>$tasks]);
    }
	public function store(Request $request) {
		// validatino
		$this->validate($request, [
			'name' => 'required|max:255',
		]);
		// create a new task based on user tasks relationship
		$task = $request->user()->tasks()->create([
			'name' => $request->name,
		]);
		// return task with user object
		return response()->json($task->with('user')->find($task->id));
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$task = Task::findOrFail($id);
		return response()->json([
			'task' => $task,
		]);
	}
    public function complete(Request $request, $id)
	{
		$input = $request->all();
		$task = Task::findOrFail($id);
		$task->update();
		return response()->json($task->with('user')->find($task->id));

		// $task = Task::find($id);
		// $input = $request->all();
		// $task = Task::findOrFail($id);
		//$task = $request->user()->tasks()->complete([
			// 'name' => $request->name,
		//]);
		// return task with user object
		//return response()->json($task->with('user')->find($task->id));
		
		return response()->json($task->with('user')->find($task->id));
	}
	public function update(Request $request, $id) {
		$input = $request->all();
		$task = Task::findOrFail($id);
		$task->update($input);
		return response()->json($task->with('user')->find($task->id));
	}

	public function destroy($id) {
		Task::findOrFail($id)->delete();
    }
    // public function complete($id) {
	// 	$task = Task::findOrFail($id)->update();
	// 	return response()->json([
	// 		'task' => $task,
	// 	]);
    // }
    public function result(Request  $request)
    {
        $result=SearchData::where('name', 'LIKE', "%{$request->input('query')}%")->get();
        return response()->json($result);
	}
	
}
