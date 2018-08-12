<?php

namespace App\Http\Controllers\EmployeeWorkExperience;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;
use App\Model\WorkExperience;
use DateTime;
use Carbon\Carbon;
class workExperienceController extends Controller
{
    public function workExperienceFormGet($employee_id)
    {
        $work_experience_data = WorkExperience::where('employee_id',$employee_id)->get();

        //dd($emergency_contact_data);

        return view('employee.work_experiences')->with('work_experience_data',$work_experience_data)->with('employee_id', $employee_id);
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

    public function workExperienceAddPost($employee_id, Request $request)
    {
        if ($request->worked_from == null)
        {
            $job_start_date = null;
        }
        else
        {
            $job_start_date = $this->getTimeFormat($request->worked_from);
        }

        if ($request->worked_to == null)
        {
            $job_end_date = null;
        }
        else
        {
            $job_end_date = $this->getTimeFormat($request->worked_to);
        }
        $insert_work_experience_data = WorkExperience::create([
            'employee_id' =>$employee_id,
            'worked_company_name' => $request->worked_company_name,
            'worked_job_title' => $request->worked_job_title,
            'worked_from' => $job_start_date,
            'worked_to' => $job_end_date,
            'comments' => $request->comments
        ]);

        if($insert_work_experience_data){
            return response()->json(["success"=>true],200);
        }else{
            return response()->json(["success"=>false],200);
        }
    }

    public function workExperienceEditDataGet($id)
    {
        $work_experience_data = WorkExperience::where('id',$id)->first();

        return response()->json($work_experience_data);
    }


    public function workExperienceEditPost($id,Request $request)
    {

        if ($request->worked_from == null)
        {
            $job_start_date = null;
        }
        else
        {
            $job_start_date = $this->getTimeFormat($request->worked_from);
        }

        if ($request->worked_to == null)
        {
            $job_end_date = null;
        }
        else
        {
            $job_end_date = $this->getTimeFormat($request->worked_to);
        }

        $update_work_experience_data = WorkExperience::where('id',$id)->update([
            'employee_id' => $request->employee_id,
            'worked_company_name' => $request->worked_company_name,
            'worked_job_title' => $request->worked_job_title,
            'worked_from' => $job_start_date,
            'worked_to' => $job_end_date,
            'comments' => $request->comments
        ]);

        if($update_work_experience_data){
            return response()->json(["success"=>true],200);
        }else{
            return response()->json(["success"=>false],200);
        }

    }

    public function deleteWorkExperience($id, Request $request)
    {
        $work_experience_data = WorkExperience::where('id',$id)->first();

        if($work_experience_data)
        {
            $work_experience_data->delete();
            return response()->json(['success' => true], 200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
