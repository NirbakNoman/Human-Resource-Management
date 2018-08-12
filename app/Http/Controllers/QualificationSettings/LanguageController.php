<?php

namespace App\Http\Controllers\QualificationSettings;

use App\Model\Language;
use Illuminate\Http\Request;
use App\Model\Skill;
use App\Http\Controllers\Controller;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    public function addLanguage(Request $request)
    {

        $insertInLanguage = Language::create([
                'name' => $request->name

            ]
        );
        return response()->json(['success'=> true],200);

    }

    public function languageListGet(Request $request)
    {
        $language_data = Language::all();
        return view('qualification_set_up.set_languages')->with('language_data',$language_data);

    }

    public function getLanguageResponse($id)
    {

        $alanguageRes = Language::find($id);
        return response()->json($alanguageRes);

    }

    public function editLanguagePost($id,Request $request)
    {
        $alanguage = Language::find($id);

        $updateInLanguage = $alanguage->update([
                'name' => $request->name
            ]
        );
        return response()->json(['success'=> true],200);
        //return response()->json($alanguage);
    }


    public function languageEditGet($id,Request $request)
    {
        $alanguage = Language::find($id);
        return view('qualification_set_up.set_languages')->with('alanguage', $alanguage);
    }


    public function deleteLanguage($id)
    {
        $languages = Language::where('id',$id)->first();

        if($languages)
        {
            $languages->delete();
            return response()->json(["success"=>true],200);
        }
        else
        {
            return response()->json(["success"=>false],200);
        }
    }
}
