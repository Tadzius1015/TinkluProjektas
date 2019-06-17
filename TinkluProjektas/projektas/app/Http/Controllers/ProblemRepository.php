<?php


namespace App\Http\Controllers;


use App\Problem;
use Illuminate\Http\Request;

class ProblemRepository
{
    public function getAllProblems()
    {
        $problems = Problem::where('problems.status', '=', 'Užregistruota')->with('operator')->get();
        return $problems;
    }

    public function getTechnicDevices()
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $currentproblems = Problem::where('technicid', '=', $id)->where('status', '=', 'Remontuojamas')->get();

        return $currentproblems;
    }

    public function createProblem(Request $request)
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $ip = $request->getClientIp();
        $datetime = date('Y-m-d H:i:s');
        Problem::create([
            'devicename' => $request['devicename'],
            'description' => $request['description'],
            'ip' => $ip,
            'registrationtime' => $datetime,
            'status' => 'Užregistruota',
            'operatorid' => $id,
        ]);
        return true;
    }

    public function takeDevice($id, Request $request)
    {
        $techid = \Illuminate\Support\Facades\Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');
        if ($problem = Problem::find($id)) {
            $problem->status = 'Remontuojamas';
            $problem->takingtime = $datetime;
            $problem->technicid = $techid;

            $problem->save();

            return true;
        }
        else {
            return false;
        }

    }

    public function getProblemByID($id)
    {
        $problem = Problem::find($id);

        return $problem;
    }

    public function updateProblem($id, Request $request)
    {
        if ($problem = Problem::find($id)) {
            $problem->technicdescription = $request['technicdescription'];
            $datetime = date('Y-m-d H:i:s');
            if ($request['status'] == 'Suremontuota') {
                $problem->status = $request['status'];
                $problem->fixingtime = $datetime;
            }
            $problem->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Problemos aprašymas buvo sėkmingai atnaujintas');

            return true;
        }
        else {
            return false;
        }

    }

    public function getSolvedProblems()
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $solvedproblems = Problem::where('technicid','=', $id)->where('status','=', 'Suremontuota')->get();

        return $solvedproblems;
    }

    public function getProblemForReport($id)
    {
        $problem = Problem::where('problems.id', '=', $id)->with('operator')->get();

        return $problem;
    }
}