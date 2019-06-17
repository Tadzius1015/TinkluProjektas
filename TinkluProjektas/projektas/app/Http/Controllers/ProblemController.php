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

    protected $repository;

    public function __construct(ProblemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $problems = $this->repository->getAllProblems();
        return view('problem.problemsList', compact('problems'));
    }

    public function getTechnicDevices()
    {
        $currentproblems = $this->repository->getTechnicDevices();

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

        $status = $this->repository->createProblem($request);
        if ($status == true)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Sėkmingai pridėjote problemą.');

            return view('problem.newProblem');
        }
    }

    public function takeDevice($id, Request $request)
    {
        $status = $this->repository->takeDevice($id, $request);
        if ($status == true) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Sėkmingai paėmėte problemą sprendimui');
            return redirect('/problemslist');
        }
        else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Problemos nepavyko paimti');
            return redirect('/problemslist');
        }
    }

    public function getProblemByID($id)
    {
        $problem = $this->repository->getProblemByID($id);
        return view('problem.problemEdit', compact('problem'));
    }

    public function updateProblem($id, Request $request)
    {
        $status = $this->repository->updateProblem($id, $request);
        if ($status == true) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Problemos aprašymas buvo sėkmingai atnaujintas');
            return redirect('/myproblems');
        }
        else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Tokios problemos neradome duomenų bazėje');
            return redirect('/myproblems');
        }
    }

    public function getSolvedProblems()
    {
        $solvedproblems = $this->repository->getSolvedProblems();

        return view('problem.solvedProblemsList', compact('solvedproblems'));
    }

    public function getProblemForReport($id)
    {
        $problem = $this->repository->getProblemForReport($id);

        return view('report.newReport', compact('problem'));
    }
}