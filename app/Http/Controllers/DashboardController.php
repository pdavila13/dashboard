<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Task;
use App\Thread;
use Cache;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['labels1'] =  "['January', 'February', 'March', 'April', 'May', 'June', 'July']";
        $data['values1'] =  "[10,42,4,23,43,76]";
        $data['labels2'] =  "['January', 'February', 'March', 'April', 'May', 'June', 'July']";
        $data['values2'] =  "[10,42,4,23,43,76]";

        return view('dashboard',$data);
    }

    public function graph1()
    {
        $data = [];
        $data['labels3']= ['Pepe', 'Maria', 'Jaume', 'Abril', 'Paolo'];
        $data['values3']= [45,56,43,23,12];

        return $data;
    }

    public function tasks()
    {
        return Task::all();
    }

    public function tasksNumber()
    {
        // CACHE MISS --> No ho troba
        // CACHE HIT --> s'ha trobat valor a la cache
        $value = Cache::remember('tasksNumber', 5, function () {
           // Codi a executar si CACHE MISS
            return Task::all()->count();
        });

        return $value;
    }

    public function threadsNumber()
    {
        return Thread::all()->count();
    }

    public function createRandomTask()
    {
        factory(\App\Task::class)->states('user')->create();
    }

    public function createRandomThread()
    {
        factory(\App\Thread::class)->create();
    }

    public function fetchActivityFeed()
    {
        return Activity::all();
    }
}
