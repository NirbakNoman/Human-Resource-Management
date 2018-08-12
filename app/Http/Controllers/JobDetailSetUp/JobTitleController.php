<?php

namespace App\Http\Controllers\JobDetailSetUp;

use App\Model\JobTitle;
use App\Model\Department;
use App\Model\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class JobTitleController extends Controller
{
    public function jobTitleListGet(Request $request)
    {
        $job_title_data = JobTitle::all();
        $department_list = Department::all();
        return view('job_set_up.set_job_title')
            ->with('job_title_data',$job_title_data)
            ->with('department_list',$department_list);
    }

    public function addJobTitle(Request $request)
    {

        $rules = [
            'job_title' => 'required',
            'job_title_code' => 'required',
            'department_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success" => false,
                "message" => $validator->errors()->all()], 200);
        }

        $insert_in_job_title = JobTitle::create([
                'job_title' => $request->job_title,
                'department_id' => $request->department_id,
                'job_title_code' => $request->job_title_code,
                'description' => $request->description
            ]
        );
        return response()->json(['success'=> true],200);
    }

    public function getJobTitleData($id)
    {
        $job_title_res = JobTitle::find($id);
        return response()->json($job_title_res);
    }

    public function editJobTitleDataPost($id,Request $request)
    {
        $job_title_data = JobTitle::find($id);

        $update_in_job_title = $job_title_data->update([
                'job_title' => $request->job_title,
                'department_id' => $request->department_id,
                'job_title_code' => $request->job_title_code,
                'description' => $request->description
            ]
        );
        return response()->json(['success'=> true],200);
    }

    public function deleteJobTitle($id)
    {
        $job_title_data = JobTitle::where('id',$id)->first();

        if($job_title_data)
        {
            $job_title_data->delete();
            return response()->json(["success"=>true],200);
        }
        else
            return response()->json(["success"=>false],200);

    }
}
