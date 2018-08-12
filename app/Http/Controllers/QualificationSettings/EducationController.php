<?php

namespace App\Http\Controllers\QualificationSettings;

use App\Model\Education;
use App\Model\Language;
use Illuminate\Http\Request;
use App\Model\Skill;
use App\Http\Controllers\Controller;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    public function addEducation(Request $request)
    {

        $insertInEducation = Education::create([
                'education_level' => $request->education_level

            ]
        );
        return response()->json(['success'=> true],200);

    }

    public function educationListGet(Request $request)
    {
        $education_data = Education::all();
        return view('qualification_set_up.set_education')->with('education_data',$education_data);

    }

    public function getEducationResponse($id)
    {

        $aeducationRes = Education::find($id);
        return response()->json($aeducationRes);

    }

    public function editEducationPost($id,Request $request)
    {

        $aeducation = Education::find($id);

        $updateInEducation = $aeducation->update([
                'education_level' => $request->education_level
            ]
        );
        return response()->json(['success'=> true],200);
       // return response()->json($aeducation);
    }


    public function educationEditGet($id,Request $request)
    {
        $aeducation = Education::find($id);
        return view('qualification_set_up.set_education')->with('aeducation', $aeducation);
    }


    public function deleteEducation($id)
    {
        $education_levels = Education::where('id',$id)->first();

        if($education_levels)
        {
            $education_levels->delete();
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
