<?php

namespace App\Http\Controllers\QualificationSettings;

use Illuminate\Http\Request;
use App\Model\Skill;
use App\Http\Controllers\Controller;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class skillController extends Controller
{

    public function addSkill(Request $request)
    {

        $insertInSkill = Skill::create([
                'name' => $request->name,
                'description' => $request->description,
            ]
        );
        return response()->json(['success'=> true],200);

    }

    public function skillListGet(Request $request)
    {
        $skill_data = Skill::all();
        return view('qualification_set_up.set_skills')->with('skill_data',$skill_data);

    }

    public function getSkillResponse($id)
    {

        $askillRes = Skill::find($id);
        return response()->json($askillRes);

    }

    public function editSkillPost($id,Request $request)
    {

        $askill = Skill::find($id);

        $updateInSkill = $askill->update([
                'name' => $request->name,
                'description' => $request->description,
            ]
        );
        return response()->json(['success'=> true],200);
        //return response()->json($askill);

    }




    public function skillEditGet($id,Request $request)
    {
        $askill = Skill::find($id);
        return view('qualification_set_up.set_skills')->with('askill', $askill);
    }


    public function deleteSkill($id)
    {
        //$banner_id = $request->banner_id;
        $skills = Skill::where('id',$id)->first();

        if($skills)
        {
            $skills->delete();
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
