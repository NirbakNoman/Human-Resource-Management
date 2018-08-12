<?php

namespace App\Http\Controllers\EmployeeLanguage;

use Illuminate\Http\Request;
use App\Model\Employee;
use App\Model\Language;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class EmployeeLanguageController extends Controller
{
    public function employeeLanguageFormGet($employee_id)
    {
        $employee_language_data = Employee::find($employee_id);
        $language_data = Language::all();
            //dd($employee_language_data->languages);
        return view('employee.languages')->with('employee_language_data', $employee_language_data->languages)
            ->with('employee_id', $employee_id)
            ->with('language_data',$language_data);
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

    public function employeeLanguageAddPost($employee_id, Request $request)
    {
        if(!is_null(Employee::find($employee_id)))
        {
            $insert_language_data = Employee::find($employee_id)->languages()->attach($request->language_id,[
                'fluency_type' => $request->fluency_type,
                'competency_type' => $request->competency_type,
                'comments' => $request->comments
            ]);
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }
    }

    public function employeeLanguageEditDataGet($languageId, Request $request)
    {
        $language_data = DB::table('employee_language')->where('employee_id',$request->employee_id)
            ->where('language_id', $languageId)->first();
        return response()->json($language_data);
    }

    public function employeeLanguageEditPost($id,Request $request)
    {
        $employee_id = $request->employee_id;
        $languageId = $id;

        $language_data = DB::table('employee_language')->where('employee_id',$employee_id)
            ->where('language_id',$languageId)->first();

        if($language_data)
        {
            $update_skill = DB::table('employee_language')->where('employee_id',$employee_id)
                ->where('language_id',$languageId)
                ->update([
                    'employee_id' => $employee_id,
                    'language_id' => $request->language_id,
                    'fluency_type' => $request->fluency_type,
                    'competency_type' => $request->competency_type,
                    'comments' => $request->comments
                ]);
            return response()->json(["success"=>true],200);
        }
        else
            return response()->json(["success"=>false],200);
    }

    public function deleteEmployeeLanguage($id, Request $request)
    {
        $employee_id = $request->employee_id;

        if(!is_null(Employee::find($employee_id)))
        {
            $delete_language_data = DB::table('employee_language')->where('employee_id',$employee_id)
                ->where('language_id',$id)
                ->delete();
            return response()->json(["success"=>true],200);
        }
        else{
            return response()->json(["success"=>false],200);
        }

    }
}
