<?php

use Illuminate\Support\Facades\Route;

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}

$tasks = [
  new Task(
    1,
    'Buy groceries',
    'Task 1 description',
    'Task 1 long description',
    false,
    '2023-03-01 12:00:00',
    '2023-03-01 12:00:00'
  ),
  new Task(
    2,
    'Sell old stuff',
    'Task 2 description',
    null,
    false,
    '2023-03-02 12:00:00',
    '2023-03-02 12:00:00'
  ),
  new Task(
    3,
    'Learn programming',
    'Task 3 description',
    'Task 3 long description',
    true,
    '2023-03-03 12:00:00',
    '2023-03-03 12:00:00'
  ),
  new Task(
    4,
    'Take dogs for a walk',
    'Task 4 description',
    null,
    false,
    '2023-03-04 12:00:00',
    '2023-03-04 12:00:00'
  ),
];

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


// use() creates a copy of the variable (or a reference, if you use &) 
// and makes it accessible inside the closure:
Route::get('/tasks',function() use($tasks) {
    return view('index',[
        'tasks' => $tasks
    ]);
})->name("tasks.index");


Route::get('/tasks/{id}',function($id) use($tasks) {
    
  $task = collect($tasks)->firstWhere('id', $id);
  
  return view('show',[
    'id'=> $id,
    'task'=> $task
  ]);

  // return "Task";
})->name("task.show");


Route::fallback(function() {
    return "No enemies";
});

