<?php


namespace App\Http\Controllers;


use App\Problem;
use App\ReportDevice;
use App\ReportWorker;
use App\User;
use Illuminate\Http\Request;

class ReportRepository
{
    public function addReport(Request $request)
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = User::find($id);
        $start_time = \Carbon\Carbon::parse($request['fixingtime']);
        $finish_time = \Carbon\Carbon::parse($request['registrationtime']);
        $result = $finish_time->diffInDays($start_time, false);
        $query = ReportDevice::all()->toArray();
        foreach ($query as $tmp) {
            if ($tmp['registrationtime'] == $request['registrationtime']) {
                return false;
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
        return true;
    }

    public function addWorkerReport(Request $request)
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = User::find($id);
        $query = Problem::where('technicid','=',$id)->where('status','=','Remontuojamas')->where('registrationtime','>=',$request['intervalbegin'])->where('takingtime','<=',$request['intervalend'])->get();
        $queryanother = Problem::where('technicid','=',$id)->where('status','=','Suremontuota')->where('registrationtime','>=',$request['intervalbegin'])->where('fixingtime','<=',$request['intervalend'])->get();
        $avgtakingtime = 0;
        $avgfixingtime = 0;
        foreach ($query as $tmp) {
            $startTime = \Carbon\Carbon::parse($tmp->registrationtime);
            $finishTime = \Carbon\Carbon::parse($tmp->takingtime);
            $totalDuration = $finishTime->diffInMinutes($startTime);
            $avgtakingtime += $totalDuration;
        }
        foreach ($queryanother as $tmp) {
            $startTime = \Carbon\Carbon::parse($tmp->registrationtime);
            $finishTime = \Carbon\Carbon::parse($tmp->fixingtime);
            $totalDuration = $finishTime->diffInMinutes($startTime);
            $avgfixingtime += $totalDuration;
        }
        if (count($query) == 0) {
            return -1;
        }
        if (count($queryanother) == 0) {
            return 0;
        }
        $avgtakingtime = $avgtakingtime / count($query);
        $avgfixingtime = $avgfixingtime / count($queryanother);
        $tmp = count($queryanother);
        $tmp1 = count($query);
        $report = ReportWorker::create([
            'workername' => $user['name'],
            'workersurname' => $user['surname'],
            'avgresponsetime' => $avgtakingtime,
            'avgfixingtime' => $avgfixingtime,
            'intervalbegin' => $request['intervalbegin'],
            'intervalend' => $request['intervalend'],
            'repaireddevicescount' => $tmp,
            'takingdevicescount' => $tmp1 + $tmp,
        ]);
        return 1;
    }

    public function getReportsFromDB(Request $request)
    {
        if ($request['reportchoice'] == 'Darbuotojų veiklos ataskaita') {
            $reportWorkers = ReportWorker::where('intervalbegin','>=',$request['intervalbegin'])->where('intervalend','<=',$request['intervalend'])->get();

            return $reportWorkers;
        }
        if ($request['reportchoice'] == 'Prietaisų veikimo ataskaita') {
            $reportDevices = ReportDevice::where('registrationtime','>=',$request['intervalbegin'])->where('fixingtime','<=',$request['intervalend'])->get();

            return $reportDevices;
        }
    }

    public function getDeviceReportByID($id)
    {
        $report = ReportDevice::find($id);

        return $report;
    }
}