<?php

namespace App\Http\Controllers\EmployeeEducation;

use App\Model\EmployeeSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;
use App\Model\Education;
use DateTime;
use Carbon\Carbon;

class EmployeeEducationController extends Controller
{
    public function employeeEducationFormGet($employee_id)
    {
        $employee_education_data = Employee::find($employee_id);
        $education_data = Education::all();

       // dd($employee_education_data->education);
//       dd($employee_skill_data);

        return view('employee.education')->with('employee_education_data',$employee_education_data->education)
            ->with('employee_id', $employee_id)
            ->with('education_data',$education_data);
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

    public function employeeEducationAddPost($employee_id, Request $request)
    {
        if($request->start_date == null)
        {
            $education_start_date = null;

        }
        else
        {
            $education_start_date = $this->getTimeFormat($request->start_date);
        }

        if ($request->end_date == null)
        {
            $education_end_date = null;
        }
        else
        {
            $education_end_date = $this->getTimeFormat($request->end_date);
        }

        if(!is_null(Employee::find($employee_id))) {
            $insert_education_data = Employee::find($employee_id)->education()->attach($request->education_id,[
                'institution_name' => $request->institution_name,
                'major' => $request->major,
                'start_date' => $education_start_date,
                'end_date' => $education_end_date,
                'result' => $request->result,
            ]);
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }
    }

    public function employeeEducationEditDataGet($educationId, Request $request)
    {
        $education_data = DB::table('employee_education')->where('employee_id',$request->employee_id)->where('education_id', $educationId)->first();

        return response()->json($education_data);
    }

    public function employeeEducationEditPost($id,Request $request)
    {
        if($request->start_date == null)
        {
            $education_start_date = null;
        }
        else
        {
            $education_start_date = $this->getTimeFormat($request->start_date);
        }

        if ($request->end_date == null)
        {
            $education_end_date = null;
        }
        else
        {
            $education_end_date = $this->getTimeFormat($request->end_date);
        }

        $employee_id = $request->employee_id;
        $educationId = $id;

        $education_data = DB::table('employee_education')->where('employee_id',$employee_id)
            ->where('education_id',$educationId)->first();

        if($education_data)
        {
            $update_education = DB::table('employee_education')->where('employee_id',$employee_id)
                ->where('education_id',$educationId)
                ->update([
                    'employee_id' => $employee_id,
                    'education_id' => $request->education_id,
                    'institution_name' => $request->institution_name,
                    'major' => $request->major,
                    'start_date' => $education_start_date,
                    'end_date' => $education_end_date,
                    'result' => $request->result,
                ]);
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }

    }

    public function deleteEmployeeEducation($id, Request $request)
    {

        $employee_id = $request->employee_id;

        if(!is_null(Employee::find($employee_id)))
        {
            $delete_education_data = DB::table('employee_education')->where('employee_id',$employee_id)
                ->where('education_id',$id)
                ->delete();

         /*   $delete_education_data = Employee::find($employee_id)->education()->detach($id,[
                'institution_name' => $request->institution_name,
                'major' => $request->major,
                'result' => $request->result,
            ]);*/
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }

    }
}
