<?php

namespace App\Http\Controllers\EmployeeContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use App\Model\EmployeeContact;
use Illuminate\Support\Facades\DB;

class employeeContactController extends Controller
{
    public function contactFormGet($employee_id,Request $request)
    {
        $contact_data = EmployeeContact::where('employee_id',$employee_id)->first();

        return view('employee.contacts')->with('contact_data',$contact_data)->with('employee_id', $employee_id);
    }

    public function contactEditPost(Request $request)
    {
        //$requests = $request->all();
        $employee_id = $request->employee_id ;
        $contact_data = EmployeeContact::where('employee_id',$employee_id)->first();

        if(is_null($contact_data))
        {
            $employee_contact_info = EmployeeContact::create([
                'employee_id' => $employee_id,
                'present_address_street_one' => $request->present_address_street_one,
                'present_address_street_two' => $request->present_address_street_two,
                'present_address_district' => $request->present_address_district,
                'present_address_state' => $request->present_address_state,
                'present_address_zip' => $request->present_address_zip,
                'permanent_address_street_one' => $request->permanent_address_street_one,
                'permanent_address_street_two' => $request->permanent_address_street_two,
                'permanent_address_district' => $request->permanent_address_district,
                'permanent_address_state' => $request->permanent_address_state,
                'permanent_address_zip' => $request->permanent_address_zip,
                'home_telephone' => $request->home_telephone,
                'work_telephone' => $request->work_telephone,
                'mobile' => $request->mobile,
                'work_mail' => $request->work_mail,
                'other_mail' => $request->other_mail,

            ]);
        }
        else
        {
            $employee_contact_info = EmployeeContact::where('employee_id', $employee_id)->update([
                'present_address_street_one' => $request->present_address_street_one,
                'present_address_street_two' => $request->present_address_street_two,
                'present_address_district' => $request->present_address_district,
                'present_address_state' => $request->present_address_state,
                'present_address_zip' => $request->present_address_zip,
                'permanent_address_street_one' => $request->permanent_address_street_one,
                'permanent_address_street_two' => $request->permanent_address_street_two,
                'permanent_address_district' => $request->permanent_address_district,
                'permanent_address_state' => $request->permanent_address_state,
                'permanent_address_zip' => $request->permanent_address_zip,
                'home_telephone' => $request->home_telephone,
                'work_telephone' => $request->work_telephone,
                'mobile' => $request->mobile,
                'work_mail' => $request->work_mail,
                'other_mail' => $request->other_mail,

            ]);
        }



        if($employee_contact_info){
            return response()->json(["success"=>true, "data"=>$employee_contact_info]);
        }else{
            return response()->json(["success"=>false, "data"=>null]);
        }
    }
}
