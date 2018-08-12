<?php

namespace App\Http\Controllers\EmergencyContact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\EmployeeEmergencyContact;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmergencyContactController extends Controller
{
    public function emergencyContactGet($employee_id)
    {
        $emergency_contact_data = EmployeeEmergencyContact::where('employee_id',$employee_id)->get();

        //dd($emergency_contact_data);

        return view('employee.emergency_contact')->with('emergency_contact_data',$emergency_contact_data)->with('employee_id', $employee_id);
    }

    public function emergencyContactAddPost($employee_id, Request $request)
    {
        $insert_contact_data = EmployeeEmergencyContact::create([
            'employee_id' => $employee_id,
            'contact_name' => $request->contact_name,
            'contact_relation' => $request->contact_relation,
            'contact_home_telephone' => $request->contact_home_telephone,
            'contact_mobile' => $request->contact_mobile
        ]);

        if($insert_contact_data){
            return response()->json(["success"=>true,"data"=>$insert_contact_data]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }

    }


    public function emergencyContactDataGet($id)
    {
        $emergency_contact_data = EmployeeEmergencyContact::where('id',$id)->first();

        return response()->json($emergency_contact_data);
    }



    public function emergencyContactPost($id,Request $request)
    {

        $update_contact_data = EmployeeEmergencyContact::where('id',$id)->update([
                'employee_id' => $request->employee_id,
                'contact_name' => $request->contact_name,
                'contact_relation' => $request->contact_relation,
                'contact_home_telephone' => $request->contact_home_telephone,
                'contact_mobile' => $request->contact_mobile
            ]);

        if($update_contact_data){
            return response()->json(["success"=>true,"data"=>$update_contact_data]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }

    }

    public function deleteEmergencyContact($id, Request $request)
    {
        $contact_data = EmployeeEmergencyContact::where('id',$id)->first();

        if($contact_data)
        {
            $contact_data->delete();
            return response()->json(['success' => true], 200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
