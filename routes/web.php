<?php
use App\Task;
use Illuminate\Http\Request;

Route::get('/', function(){
    return view('welcome');
    
});

//タスクダッシュボード表示
Route::get('/', function () {
    $tasks = Task::orderBy('created_at','asc')->get();
    return view('tasks.tasks',[
        'tasks' => $tasks
    ]);
});

//新タスク追加
Route::post('/task',function(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task;
    $task->name =$request->name;
    $task->save();
    
    return redirect('/');

    // タスク作成処理…
});

//タスク削除
Route::delete('/task/{task}',function (Task $task){
    $task->delete();
    
    return redirect('/');
    
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
