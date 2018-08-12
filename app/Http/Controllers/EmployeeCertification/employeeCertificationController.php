<?php

namespace App\Http\Controllers\EmployeeCertification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;
use App\Model\EmployeeCertification;
use App\Model\EmployeeDependent;
use DateTime;
use Carbon\Carbon;

class employeeCertificationController extends Controller
{
    public function certificationFormGet($employee_id)
    {
        $certification_data = EmployeeCertification::where('employee_id',$employee_id)->get();

        //dd($emergency_contact_data);

        return view('employee.certifications')->with('certification_data',$certification_data)->with('employee_id', $employee_id);
    }

    public function getTimeFormat($dateString)
    {
        try{
            return Carbon::createFromFormat('Y-m-d\TH:i:s.uT', $dateString);
        }
        catch(\Exception $ex){
            try{
                return Carbon::createFromFormat('Y-m-d', $dateString);
            }
            catch(\Exception $ex){

            }
        }
        return null;
    }

    public function certificationAddPost($employee_id, Request $request)
    {
        if ($request->granted_on==null)
        {
            $granted_on =   null;
        }
        else {
            $granted_on = $this->getTimeFormat($request->granted_on);
        }

        if ($request->valid_till==null)
        {
            $valid_till =   null;
        }
        else {
            $valid_till = $this->getTimeFormat($request->valid_till);
        }


        $insert_certification_data = EmployeeCertification::create([
            'employee_id' => $employee_id,
            'certification' => $request->certification,
            'institute' => $request->institute,
            'granted_on' => $granted_on,
            'valid_till' => $valid_till
        ]);

        if($insert_certification_data){
            return response()->json(["success"=>true],200);
        }else{
            return response()->json(["success"=>false],200);
        }
    }

    public function certificationEditDataGet($id)
    {
        $certification_data = EmployeeCertification::where('id',$id)->first();

        return response()->json($certification_data);
    }


    public function certificationEditPost($id,Request $request)
    {

        if ($request->granted_on==null)
        {
            $granted_on =   null;
        }
        else {
            $granted_on = $this->getTimeFormat($request->granted_on);
        }

        if ($request->valid_till==null)
        {
            $valid_till =   null;
        }
        else {
            $valid_till = $this->getTimeFormat($request->valid_till);
        }

        $update_certification_data = EmployeeCertification::where('id',$id)->update([
            'employee_id' => $request->employee_id,
            'certification' => $request->certification,
            'institute' => $request->institute,
            'granted_on' => $granted_on,
            'valid_till' => $valid_till
        ]);

        if($update_certification_data)
        {
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }

    }

    public function deleteCertification($id, Request $request)
    {
        $certification_data = EmployeeCertification::where('id',$id)->first();

        if($certification_data)
        {
            $certification_data->delete();
            return response()->json(['success' => true], 200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
