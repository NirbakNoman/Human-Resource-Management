<?php

namespace App\Http\Controllers\EmployeeSkill;

use App\Model\EmployeeSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;
use App\Model\Skill;
use DateTime;
use Carbon\Carbon;

class EmployeeSkillController extends Controller
{
    public function employeeSkillFormGet($employee_id)
    {
        $employee_skill_data = Employee::find($employee_id);

        $skill_data = Skill::all();
        //dd($employee_skill_data->skills);

        return view('employee.skills')->with('employee_skill_data',$employee_skill_data->skills)->with('employee_id', $employee_id)
            ->with('skill_data',$skill_data);
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

    public function employeeSkillAddPost($employee_id, Request $request)
    {
        if(!is_null(Employee::find($employee_id))) {
            $insert_skill_data = Employee::find($employee_id)->skills()->attach($request->skill_id,[
                'year_of_experiance' => $request->year_of_experiance,
                'comments' => $request->comments,
            ]);
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }
    }

    public function employeeSkillEditDataGet($skillId, Request $request)
    {
        $skill_data = DB::table('employee_skill')->where('employee_id',$request->employee_id)->where('skill_id', $skillId)->first();

        return response()->json($skill_data);
    }

    public function employeeSkillEditPost($id,Request $request)
    {

        $employee_id = $request->employee_id;
        $skillId = $id;

        $skill_data = DB::table('employee_skill')->where('employee_id',$employee_id)
            ->where('skill_id',$skillId)->first();

        if($skill_data)
        {
            $update_skill = DB::table('employee_skill')->where('employee_id',$employee_id)
                ->where('skill_id',$skillId)
                ->update([
                'employee_id' => $employee_id,
                'skill_id' => $request->skill_id,
                'year_of_experiance' => $request->year_of_experiance,
                'comments' => $request->comments,
            ]);
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }

    }

    public function deleteEmployeeSkill($id, Request $request)
    {
        $employee_id = $request->employee_id;

        if(!is_null(Employee::find($employee_id))) {

           /* $delete_skill_data = Employee::find($employee_id)->skills()->detach($id,[
                'year_of_experiance' => $request->year_of_experiance,
                'comments' => $request->comments,
            ]);*/

            $delete_language_data = DB::table('employee_skill')->where('employee_id',$employee_id)
                ->where('skill_id',$id)
                ->delete();
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }

    }
}
