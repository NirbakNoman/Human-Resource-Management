<?php

namespace App\Http\Controllers\JobDetailSetUp;

use App\Model\Department;
use App\Model\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function departmentListGet(Request $request)
    {
        $department_data = Department::all();
        return view('job_set_up.set_department')->with('department_data',$department_data);
    }

    public function addDepartment(Request $request)
    {
        $rules = [
            'department' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success" => false,
                "message" => $validator->errors()->all()], 200);
        }

        $insert_in_department = Department::create([
                'department' => $request->department
            ]
        );
        return response()->json(['success'=> true],200);
    }

    public function getDepartmentData($id)
    {
        $aeducationRes = Department::find($id);
        return response()->json($aeducationRes);
    }

    public function editDepartmentDataPost($id,Request $request)
    {
        $department_data = Department::find($id);

        $update_in_department = $department_data->update([
                'department' => $request->department
            ]
        );
        return response()->json(['success'=> true],200);
    }

    public function deleteDepartment($id)
    {
        $department_data = Department::where('id',$id)->first();

        if($department_data)
        {
            $department_data->delete();
            return response()->json(["success"=>true],200);
        }
        else
            return response()->json(["success"=>false],200);

    }
}
