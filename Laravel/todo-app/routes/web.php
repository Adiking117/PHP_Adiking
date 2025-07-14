<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// class Task
// {
//   public function __construct(
//     public int $id,
//     public string $title,
//     public string $description,
//     public ?string $long_description,
//     public bool $completed,
//     public string $created_at,
//     public string $updated_at
//   ) {
//   }
// }

// $tasks = [
//   new Task(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];


Route::get('/', function () {
    // return 'Hi';

    // return view('index');

    return view('test',[
        'name'=> 'Adiking'
    ]);

    // cant put html tags inside varibales like <b>Adiking</b> due to cross scripting

})->name("Home");

Route::get('/hello/{name}', function($name){
    return "Helllo ". $name;
})->name('Hello');

Route::get('/hallo',function(){
    // return redirect('/');
    return redirect()->route('Home');
});

Route::get('/',function(){
  return redirect()->route('tasks.index');
});

// Using Above Array as DB

// use() creates a copy of the variable (or a reference, if you use &) 
// and makes it accessible inside the closure:

// Route::get('/tasks',function() use($tasks) {
//     return view('index',[
//         'tasks' => $tasks
//     ]);
// })->name("tasks.index");


// Route::get('/tasks/{id}',function($id) use($tasks) {
    
//   $task = collect($tasks)->firstWhere('id', $id);
  
//   return view('show',[
//     // 'id'=> $id,
//     'task'=> $task
//   ]);

//   // return "Task";
// })->name("task.show");


// Using Database
Route::get('/tasks',function() {

    return view('index',[
        'tasks' => \App\Models\Task::all() // Old first
        // 'tasks' => \App\Models\Task::latest()->get() // New first
        // 'tasks' => \App\Models\Task::latest()->where('completed',true)->get() // Query builder
        // 'tasks' => \App\Models\Task::select('id','title')->where('completed',true)->get() // Query builder
    ]);

})->name("tasks.index");


Route::view('/tasks/create','create')->name('tasks.create');


Route::get('/tasks/{id}',function($id)  {

  // $task = \App\Models\Task::find($id);

  // if(!$task) abort(404);

  return view('show',  [
  //   'task'=> $task
    'task'=> \App\Models\Task::findOrFail($id)
  ]);

})->name("tasks.show");


Route::post("/tasks",function(Request $request) {
    // dd($request->all());

    $data = $request->validate([
        "title"=> "required|max:255",
        "description"=> "required",
        "long_description"=> "required",
    ]);

    $taskToAdd = new Task();
    $taskToAdd->title = $data["title"];
    $taskToAdd->description = $data["description"];
    $taskToAdd->long_description = $data["long_description"];
    $taskToAdd->completed= false;
    $taskToAdd->save();

    return redirect()->route("tasks.show",['id'=>$taskToAdd->id])
    ->with('success','Task Created Successfully!');

})->name("tasks.store");



Route::get('/tasks/{id}/update',function($id)  {

  return view('edit',  [
    'task'=> \App\Models\Task::findOrFail($id)
  ]);

})->name("tasks.edit");


Route::put("/tasks/{id}/update",function(Request $request,$id){
    $task = Task::findOrFail($id);

    $data = $request->validate([
        "title"=> "required|max:255",
        "description"=> "required",
        "long_description"=> "required",
    ]);

    $task->title = $data["title"];
    $task->description = $data["description"];
    $task->long_description = $data["long_description"];

    $task->save();

    return view("tasks.show",[
        "task"=>$task
    ])->with("success","Task updated successfully");


})->name("tasks.update");



Route::fallback(function() {
    return "No enemies";
});

