<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function createJobListing(){
        // $job = new App\Models\Job ; 
       // App\Models\Job::factory(30)->create() ;

       $this->factory(30)->create();

    }
}
