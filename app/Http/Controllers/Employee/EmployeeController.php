<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\EmployeeEmergencyContact;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function personnerDetailsGet($employee_id,Request $request)
    {
        $employee_data = Employee::where('id',$employee_id)->first();

        return view('employee.personal_details')->with('employee_data',$employee_data);
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
    public function employeeAddFormPost(Request $request)
    {
        if ($request->date_of_birth==null)
        {
            $date_of_birth =   null;
        }
        else
        {
            $date_of_birth = $this->getTimeFormat($request->date_of_birth);
        }

        if ($request->passport_expiry_date==null)
        {
            $passport_expiry_date =   null;
        }
        else
        {
            $passport_expiry_date = $this->getTimeFormat($request->passport_expiry_date);
        }

        if ($request->license_expiry_date==null)
        {
            $license_expiry_date =   null;
        }
        else
        {
            $license_expiry_date = $this->getTimeFormat($request->license_expiry_date);
        }


        $employeeInfo = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'employee_code' => $request->employee_code,
            'national_id' => $request->national_id,
            'date_of_birth' => $date_of_birth,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'passport_number' => $request->passport_number,
            'passport_expiry_date' => $passport_expiry_date,
            'driving_license_number' => $request->driving_license_number,
            'license_expiry_date' => $license_expiry_date


        ]);
        if($employeeInfo){
            return response()->json(["success"=>true,"data"=>$employeeInfo]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }
    }

    public function employeeListGet(Request $request)
    {
        $employee_data = Employee::all();
        return view('employee.employee_list')->with('employee_data',$employee_data);
    }

    public function employeeAddFormGet()
    {
        return view('employee.add_employee');
    }

    public function deleteEmployee($employee_id, Request $request)
    {
        $employee_data = Employee::where('id',$employee_id)->first();

        if($employee_data)
        {
            $employee_data->delete();
            return response()->json(['success' => true], 200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }

    }

    public function personalDetailsPost(Request $request)
    {
        //$requests = $request->all();
        $employee_id = $request->employee_id ;
        //dd($employee_id);

        if ($request->date_of_birth==null)
        {
            $date_of_birth =   null;
        }
        else
        {
            $date_of_birth = $this->getTimeFormat($request->date_of_birth);
        }

        if ($request->passport_expiry_date==null)
        {
            $passport_expiry_date =   null;
        }
        else
        {
            $passport_expiry_date = $this->getTimeFormat($request->passport_expiry_date);
        }

        if ($request->license_expiry_date==null)
        {
            $license_expiry_date =   null;
        }
        else
        {
            $license_expiry_date = $this->getTimeFormat($request->license_expiry_date);
        }


        $employee_info = Employee::where('id',$employee_id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'employee_code' => $request->employee_code,
            'national_id' => $request->national_id,
            'date_of_birth' => $date_of_birth,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'passport_number' => $request->passport_number,
            'passport_expiry_date' => $passport_expiry_date,
            'driving_license_number' => $request->driving_license_number,
            'license_expiry_date' => $license_expiry_date


        ]);

        if($employee_info){
            return response()->json(["success"=>true,"data"=>$employee_info]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }
    }


  /*  public function editPost(Request $request)
    {
        $requests = $request->except(['_token', 'id']);
        $employee_id = $request->employee_id;
        $employee_info = Employee::where('id',$employee_id)->first()->update($requests);
        if($employee_info){
            return response()->json(["success"=>true,"data"=>$employee_info]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }
    }*/



   /* public function assignLanguage(Request $request){
        //$requests = $request->except(['_token']);
        $employee_id = $request->employee_id;
        $language_id = $request->language_id;

        $employee = Employee::where("id",$employee_id)->first();
        //$education = Education::where("id",$degree_id)->first();
        $employee->language()->attach($language_id);

    }*/

   /* public function assignSkill(Request $request)
    {
        $employee_id = $request->employee_id;
        $skill_id = $request->skill_id;

        $employee_info = Employee::where('id',$employee_id)->first();

        $rowBeforeInsert = DB::table('employee_skill')->count();

        $emp_skill_insert = $employee_info->skill()->attach($skill_id,[
            'year_of_experiance' => $request->year_of_experiance
        ]);

        $rowAfterInsert = DB::table('employee_skill')->count();
        $data = Employee::with('skill')->take($rowAfterInsert)->where('id',$employee_id)->first();
        $skills = $data->skill->get($rowAfterInsert-2);
        if ($rowAfterInsert>$rowBeforeInsert)
        {
            return response()->json(['success' => true, 'data' => $skills ]);
        }
        else
        {
            return response()->json(['success' => false, 'data' => null]);
        }

    }*/

 /*   public function assignLicense(Request $request)
    {
        $employee_id = $request->employee_id;
        $license_id = $request->license_id;

        $employee_info = Employee::where('id',$employee_id)->first();
        $emp_license_insert = $employee_info->license()->attach($license_id,[
           'issued_date' => $request->issued_date,
            'expiry_date' => $request->expiry_date
        ]);

    }


    public function assignJob(Request  $request)
    {
        $employee_id = $request->employee_id;
        $job_id = $request->job_id;

        $employee_info = Employee::where('id',$employee_id)->first();
        $emp_job = $employee_info->job()->attach($job_id,[
            'employment_status_id' => $request->employment_status_id,
            'joining_date' => $request->joining_date
        ]);

    }

    public function assignWorkShift(Request $request)
    {
        $employee_id = $request->employee_id;
        $work_shift_id = $request->work_shift_id;

        $employee_info = Employee::where('id',$employee_id)->first();

        $employee_info->workShift()->attach($work_shift_id,[
            'date' => $request->date
        ]);
    }

    public function employeeLeaveRequest(Request $request)
    {
        $employee_id = $request->employee_id;
        $leave_type_id = $request->leave_type_id;
        $employee_info = Employee::where('id',$employee_id)->first();
        $employee_info->leaveRequest()->attach($leave_type_id,[
            'leave_start_date' => $request->leave_start_date,
            'leave_end_date' => $request->leave_end_date,
            'leave_duration' => $request->leave_duration,
            'leave_reason' => $request->leave_reason,
            'leave_status_id' => $request->leave_status_id
        ]);
    }


    public function employeeLeavePeriod(Request $request)
    {
        $employee_id = $request->employee_id;
        $leave_type_id = $request->leave_type_id;
        $employee_info = Employee::where('id',$employee_id)->first();
        $employee_info->leavePeriod()->attach($leave_type_id,[
            'leave_period_start' => $request->leave_period_start,
            'leave_period_end' => $request->leave_period_end,
            'number_of_leave_days' => $request->number_of_leave_days

        ]);
    }*/

}
