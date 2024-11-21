<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Works
{

    public static function all():array{
        return [
            [
                'id'     => 1 ,
                'title'  => 'director' ,
                'salary' => '50000' ,
            ],
            [
                'id'     => 2 ,
                'title'  => 'senior developer' ,
                'salary' => '60000' ,
            ],
            [
                'id'     => 3 ,
                'title'  => 'junior developer' ,
                'salary' => '40000' ,
            ]
        ];
    }


    public static function find(int $id): array{
        $workis = Arr::first(static::all(), function ($work) use ($id) {
            return $work['id'] == $id  ;
        });
        if(!$workis){
            abort(404);
        }
        return $workis;
    }
}
