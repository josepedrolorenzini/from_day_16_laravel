<?php

use App\Http\Controllers\ContactForm;
use illuminate\support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Works;


Route::get('/', function () {
    return view('home' ,[
        'name' => 'jose lorenzini' ,
    ]);
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);

});

// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // authorize (On hold...)

    $job = Job::findOrFail($id);

    //another way to update database fields
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save() ;

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize (On hold...)

    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});

// Route::get('/contact', function () {
//     return view(  'contact' , ['details' => 'details']);
// });

Route::get('/contact',[ContactForm::class , 'index']) ;

Route::get("/trabajos", function () {

    return view('trabajos', [
        'trabajos' => include public_path('php/trabajo.php')
    ]);

//    return response()->json([
//        'trabajo' => include public_path('php/jobs.php')
//    ]);
//

});
Route::get("/trabajos/{id}", function ($id) {
   // dd($id) ;
    $eworks = include public_path('php/trabajo.php') ;
  // dd($eworks) ;
    // Ensure $eworks is an array
    if (!is_array($eworks)) {
        return response()->json(['error' => 'Invalid data format'], 500);
    }

   $result = Arr::first($eworks , function ($tr) use ($id) {
         return $tr['id'] == $id  ;
    });

    return view('trabajo', [
        'result' => $result
    ]);

}) ;

// testing namespaces models works
Route::get("/works" , function () {
    $workis = Works::all();
    return response()->json( [
        'workis' => $workis,
    ]);
}) ;

Route::get("/works/{id}" , function ($id) {
//    $workis = Arr::first(Works::all(), function ($work) use ($id) {
//        return $work['id'] == $id  ;
//    });
    $workis = Works::find($id);
    return response()->json( [
        'workis' => $workis,
    ]);
}) ;

// testing namespaces models works
