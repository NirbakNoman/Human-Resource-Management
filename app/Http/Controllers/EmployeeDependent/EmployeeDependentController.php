<?php

namespace App\Http\Controllers\EmployeeDependent;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;
use App\Model\EmployeeEmergencyContact;
use App\Model\EmployeeDependent;
use DateTime;
use Carbon\Carbon;


class EmployeeDependentController extends Controller
{
    public function dependentFormGet($employee_id)
    {
        $dependent_data = EmployeeDependent::where('employee_id',$employee_id)->get();

        //dd($emergency_contact_data);

        return view('employee.dependents')->with('dependent_data',$dependent_data)->with('employee_id', $employee_id);
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

    public function dependentAddPost($employee_id, Request $request)
    {
        if ($request->dependent_date_of_birth==null)
        {
            $date_of_birth =   null;
        }
        else {
            $dependent_date_of_birth = $this->getTimeFormat($request->dependent_date_of_birth);
        }

        $insert_dependent_data = EmployeeDependent::create([
            'employee_id' => $employee_id,
            'dependent_name' => $request->dependent_name,
            'relationship_with_employee' => $request->relationship_with_employee,
            'dependent_date_of_birth' => $dependent_date_of_birth
        ]);

        if($insert_dependent_data){
            return response()->json(['success'=> true],200);

        }else{
            return response()->json(['success'=> false],200);
        }
    }

    public function dependentEditDataGet($id)
    {
        $dependent_data = EmployeeDependent::where('id',$id)->first();

        return response()->json($dependent_data);
    }


    public function dependentEditPost($id,Request $request)
    {

        if ($request->dependent_date_of_birth == null)
        {
            $dependent_date_of_birth = null;
        }
        else
        {
            $dependent_date_of_birth = $this->getTimeFormat($request->dependent_date_of_birth);
        }

        $update_dependent_data = EmployeeDependent::where('id',$id)->update([
            'employee_id' => $request->employee_id,
            'dependent_name' => $request->dependent_name,
            'relationship_with_employee' => $request->relationship_with_employee,
            'dependent_date_of_birth' => $dependent_date_of_birth
        ]);



        if($update_dependent_data){
            return response()->json(['success'=> true],200);

        }else{
            return response()->json(['success'=> false],200);
        }


      /*  if($update_dependent_data){
            return response()->json(["success"=>true,"data"=>$update_dependent_data]);
        }else{
            return response()->json(["success"=>false,"data"=>null]);
        }*/

    }

    public function deleteDependent($id, Request $request)
    {
        $dependent_data = EmployeeDependent::where('id',$id)->first();

        if($dependent_data)
        {
            $dependent_data->delete();
            return response()->json(['success' => true], 200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
