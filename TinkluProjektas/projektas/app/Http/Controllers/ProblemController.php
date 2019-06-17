<?php
/**
 * Created by PhpStorm.
 * User: Tadas
 * Date: 12/5/2018
 * Time: 5:27 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Problem;
use App\User;
use DB;
use Validator;

class ProblemController extends Controller
{

    public function index()
    {
        $problems = DB::table('problems')->join('users', 'problems.operatorid', '=', 'users.id')->where('problems.status', '=', 'Užregistruota')->select('problems.*','users.name', 'users.surname')->get();
        return view('problem.problemsList', compact('problems'));
    }
    public function getTechnicDevices()
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $currentproblems = DB::table('problems')->where('technicid', '=', $id)->where('status', '=', 'Remontuojamas')->get();
        return view('problem.technicProblemsList', compact('currentproblems'));
    }
    public function getForm()
    {
        return view('problem.newProblem');
    }
    public function createProblem(Request $request)
    {
        $this->validate($request,[
            'devicename'=>'required|min:6',
            'description'=>'required|min:6'
        ]);

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
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Sėkmingai pridėjote problemą.');
        return view('problem.newProblem');
    }

    public function takeDevice($id, Request $request)
    {
        $techid = \Illuminate\Support\Facades\Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');
        if($problem = Problem::find($id))
        {
            $problem->status = 'Remontuojamas';
            $problem->takingtime = $datetime;
            $problem->technicid = $techid;

            $problem->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Sėkmingai paėmėte problemą sprendimui');
            return redirect('/problemslist');
        }
        else
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Problemos nepavyko paimti');
            return redirect('/problemslist');
        }

    }

    public function getProblemByID($id)
    {
        $problem = Problem::find($id);
        return view('problem.problemEdit', compact('problem'));
    }

    public function updateProblem($id, Request $request)
    {
        if($problem = Problem::find($id))
        {
            $problem->technicdescription = $request['technicdescription'];
            $datetime = date('Y-m-d H:i:s');
            if($request['status'] == 'Suremontuota')
            {
                $problem->status = $request['status'];
                $problem->fixingtime = $datetime;
            }
            $problem->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Problemos aprašymas buvo sėkmingai atnaujintas');
            return redirect('/myproblems');
        }
        else
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Tokios problemos neradome duomenų bazėje');
            return redirect('/myproblems');
        }

    }

    public function getSolvedProblems()
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $solvedproblems = DB::table('problems')->where('technicid','=', $id)->where('status','=', 'Suremontuota')->get();
        return view('problem.solvedProblemsList', compact('solvedproblems'));
    }

    public function getProblemForReport($id)
    {
        $problem = DB::table('problems')->join('users', 'problems.operatorid', '=', 'users.id')->where('problems.id', '=', $id)->select('problems.*','users.name', 'users.surname')->get();
        return view('report.newReport', compact('problem'));
    }
}