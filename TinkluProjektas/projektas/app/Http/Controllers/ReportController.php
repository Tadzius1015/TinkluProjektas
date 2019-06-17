<?php
/**
 * Created by PhpStorm.
 * User: Tadas
 * Date: 12/7/2018
 * Time: 8:36 PM
 */

namespace App\Http\Controllers;

use App\ReportDevice;
use App\ReportWorker;
use Illuminate\Http\Request;
use App\Problem;
use App\User;
use DB;
use Validator;

class ReportController extends Controller
{
    protected $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addReport(Request $request)
    {
        $this->validate($request,[
            'shortdescription'=>'required|min:10'
            ]);

        $status = $this->repository->addReport($request);
        if($status == true) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Ataskaita buvo sėkmingai paruošta');

            return redirect('/solvedproblems');
        }
        else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Šios problemos ataskaita jau yra paruošta');

            return redirect('/solvedproblems');
        }

    }

    public function getWorkerReportForm()
    {
        return view('report.newWorkerReport');
    }

    public function addWorkerReport(Request $request)
    {
        $this->validate($request,[
            'intervalbegin'=>'required|date',
            'intervalend'=>'required|date'
        ]);

        $number = $this->repository->addWorkerReport($request);

        if ($number == -1) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Šiuo laikotarpiu problemų nebuvo paimta spręsti');

            return redirect('/prepareworkingreport');
        }
        else if ($number == 0) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Šiuo laikotarpiu problemų nebuvo išspręsta');

            return redirect('/prepareworkingreport');
        }
        else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Jūsų darbo veiklos ataskaita sėkmingai sukurta.');

            return redirect('/prepareworkingreport');
        }
    }

    public function getReportFormAdmin()
    {
        return view('report.viewReport');
    }

    function getReportsFromDB(Request $request)
    {
        $this->validate($request,[
           'intervalbegin'=>'required|date',
           'intervalend'=>'required|date'
        ]);

        if ($request['reportchoice'] == 'Darbuotojų veiklos ataskaita') {
            $reportWorkers = $this->repository->getReportsFromDB($request);

            return view('report.workersReport', compact('reportWorkers'));
        }
        if ($request['reportchoice'] == 'Prietaisų veikimo ataskaita') {
            $reportDevices = $this->repository->getReportsFromDB($request);

            return view('report.devicesReport', compact('reportDevices'));
        }
    }

    public function getDeviceReportByID($id)
    {
        $report = $this->repository->getDeviceReportByID($id);

        return view('report.concreteDeviceReport', compact('report'));
    }
}