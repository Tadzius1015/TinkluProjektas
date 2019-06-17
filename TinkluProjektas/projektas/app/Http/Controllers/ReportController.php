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
    public function addReport(Request $request)
    {
        $this->validate($request,[
            'shortdescription'=>'required|min:10'
            ]);

        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = User::find($id);
           $start_time = \Carbon\Carbon::parse($request['fixingtime']);
           $finish_time = \Carbon\Carbon::parse($request['registrationtime']);
           $result = $finish_time->diffInDays($start_time, false);
           $query = ReportDevice::all()->toArray();
           foreach ($query as $tmp)
           {
               if ($tmp['registrationtime'] == $request['registrationtime'])
               {
                   $request->session()->flash('message.level', 'danger');
                   $request->session()->flash('message.content', 'Šios problemos ataskaita jau yra paruošta');
                   return redirect('/solvedproblems');
               }
           }
        ReportDevice::create([
           'problem' => $request['devicename'],
            'description' => $request['description'],
            'registrationtime' => $request['registrationtime'],
            'takingtime' => $request['takingtime'],
            'fixingtime' => $request['fixingtime'],
            'operatorname' => $request['opname'],
            'operatorsurname' => $request['opsurname'],
            'technicname' => $user['name'],
            'technicsurname' => $user['surname'],
            'technicdescription' => $request['technicdescription'],
            'reportdescription' => $request['shortdescription'],
            'notworkingtime' => $result,
        ]);
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Ataskaita buvo sėkmingai paruošta');
        return redirect('/solvedproblems');
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

        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = User::find($id);
        $query = DB::table('problems')->where('technicid','=',$id)->where('status','=','Remontuojamas')->where('registrationtime','>=',$request['intervalbegin'])->where('takingtime','<=',$request['intervalend'])->get();
        $queryanother = DB::table('problems')->where('technicid','=',$id)->where('status','=','Suremontuota')->where('registrationtime','>=',$request['intervalbegin'])->where('fixingtime','<=',$request['intervalend'])->get();
        $avgtakingtime = 0;
        $avgfixingtime = 0;
        foreach ($query as $tmp)
        {
            $startTime = \Carbon\Carbon::parse($tmp->registrationtime);
            $finishTime = \Carbon\Carbon::parse($tmp->takingtime);
            $totalDuration = $finishTime->diffInMinutes($startTime);
            $avgtakingtime += $totalDuration;
        }
        foreach ($queryanother as $tmp)
        {
            $startTime = \Carbon\Carbon::parse($tmp->registrationtime);
            $finishTime = \Carbon\Carbon::parse($tmp->fixingtime);
            $totalDuration = $finishTime->diffInMinutes($startTime);
            $avgfixingtime += $totalDuration;
        }
        if(count($query) == 0)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Šiuo laikotarpiu problemų nebuvo paimta spręsti');
            return redirect('/prepareworkingreport');
        }
        if(count($queryanother) == 0)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Šiuo laikotarpiu problemų nebuvo išspręsta');
            return redirect('/prepareworkingreport');
        }
        $avgtakingtime = $avgtakingtime / count($query);
        $avgfixingtime = $avgfixingtime / count($queryanother);
        $tmp = count($queryanother);
        $tmp1 = count($query);
        $aa = ReportWorker::create([
            'workername' => $user['name'],
            'workersurname' => $user['surname'],
            'avgresponsetime' => $avgtakingtime,
            'avgfixingtime' => $avgfixingtime,
            'intervalbegin' => $request['intervalbegin'],
            'intervalend' => $request['intervalend'],
            'repaireddevicescount' => $tmp,
            'takingdevicescount' => $tmp1 + $tmp,
        ]);
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Jūsų darbo veiklos ataskaita sėkmingai sukurta.');
        return redirect('/prepareworkingreport');
    }

    function getReportFormAdmin()
    {
        return view('report.viewReport');
    }
    function getReportsFromDB(Request $request)
    {
        $this->validate($request,[
           'intervalbegin'=>'required|date',
           'intervalend'=>'required|date'
        ]);

        if($request['reportchoice'] == 'Darbuotojų veiklos ataskaita')
        {
            $reportWorkers = DB::table('report_workers')->where('intervalbegin','>=',$request['intervalbegin'])->where('intervalend','<=',$request['intervalend'])->get();
            return view('report.workersReport', compact('reportWorkers'));
        }
        if($request['reportchoice'] == 'Prietaisų veikimo ataskaita')
        {
            $reportDevices = DB::table('report_devices')->where('registrationtime','>=',$request['intervalbegin'])->where('fixingtime','<=',$request['intervalend'])->get();
            return view('report.devicesReport', compact('reportDevices'));
        }
    }

    public function getDeviceReportByID($id)
    {
        $report = ReportDevice::find($id);
        return view('report.concreteDeviceReport', compact('report'));
    }
}