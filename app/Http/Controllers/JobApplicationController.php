<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\AchievementList;
use App\Models\EducationBackground;
use App\Models\Family;
use App\Models\OrganizationHistory;
use App\Models\OtherAnswer;
use App\Models\ScreeningAnswer;
use App\Models\SkillList;
use App\Models\User;
use App\Models\WorkExperience;
use CreateEducationBackgroundTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) return redirect('/');
        
        $data = new JobApplication();
        if (JobApplication::where("user_id", Auth::user()->id)->count() > 0) {
            $data = JobApplication::where("user_id", Auth::user()->id)->first();
        }else {
            $data->user_id = Auth::user()->id;
            $data->save();
        }

        $screening_answer = new ScreeningAnswer();
        if (ScreeningAnswer::where("application_id", $data->id)->count() > 0) {
            $screening_answer = ScreeningAnswer::where("application_id", $data->id)->first();
        }else{
            $screening_answer->application_id = $data->id;
            $screening_answer->save();
        }
        
        $education_background = EducationBackground::where("application_id", $data->id)->get();

        $work_experience = WorkExperience::where("application_id", $data->id)->get();
        
        $organization_history = OrganizationHistory::where("application_id", $data->id)->get();

        $achievement_list = AchievementList::where("application_id", $data->id)->get();

        $skill_list = SkillList::where("application_id", $data->id)->get();

        $family = Family::where("application_id", $data->id)->get();
        
        $misc_answer = new OtherAnswer();
        if (OtherAnswer::where("application_id", $data->id)->count() > 0) {
            $misc_answer = OtherAnswer::where("application_id", $data->id)->first();
            $arr = explode(',',$misc_answer->transportation);
            if (!in_array($arr[count($arr)-1], ['car', 'motorcycle', 'bicycle'])) {
                $misc_answer->transportation_other_name = $arr[count($arr)-1]; 
                $arr[count($arr)-1] = 'other';
                $misc_answer->transportation = implode(',', $arr);
            }
            $arr = $misc_answer->residence;
            if (!in_array($arr, ['private', 'parent', 'lease', 'kos'])) {
                $misc_answer->residence_other_name = $arr;
                $misc_answer->residence = 'other';
            }
        }else{
            $misc_answer->application_id = $data->id;
            $misc_answer->save();
        }
        return view('profile', [
            'data' => $data, 
            'screening_answer' => $screening_answer, 
            'misc_answer' => $misc_answer, 
            'education_background' => $education_background, 
            'work_experience' => $work_experience, 
            'organization_history' => $organization_history,
            'achievement_list' => $achievement_list,
            'skill_list' => $skill_list,
            'family' => $family,
            'Title' => "Biodata Anda"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobApplicationRequest $request) {
        try {
            $dataToSave = $request->validated();
            
            $jobAppl = JobApplication::where("user_id", Auth::user()->id)->first();

            $jobAppl->user_short_desc = trim($dataToSave['user_short_desc']);
            if (isset($request['profile_path'])) {
                $imageName = time().'.'.$request['profile_path']->extension();  
                $request['profile_path']->move(public_path('images'), $imageName);
                $jobAppl->profile_path = "/images/{$imageName}";
            }
            $jobAppl->birthplace = $dataToSave['birthplace'];
            $jobAppl->birthdate = $dataToSave['birthdate'];
            $jobAppl->religion = $dataToSave['religion'];
            $jobAppl->race = $dataToSave['race'];
            $jobAppl->id_city = $dataToSave['id_city'];
            $jobAppl->tax_number = $dataToSave['tax_number'];
            $jobAppl->gender = $dataToSave['gender'];
            $jobAppl->phone_number = $dataToSave['phone_number'];
            $jobAppl->residence_phone = $dataToSave['residence_phone'];
            $jobAppl->address = trim($dataToSave['address']);
            $jobAppl->real_address = trim($dataToSave['real_address']);
            $jobAppl->marital_status = $dataToSave['marital_status'];
            $jobAppl->wedding_date = $dataToSave['wedding_date'];
            $jobAppl->blood_type = $dataToSave['blood_type'];
            $jobAppl->height = $dataToSave['height'];
            $jobAppl->weight = $dataToSave['weight'];
            $jobAppl->facebook = $dataToSave['facebook'];
            $jobAppl->twitter = $dataToSave['twitter'];
            $jobAppl->instagram = $dataToSave['instagram'];
            $jobAppl->linkedin = $dataToSave['linkedin'];

            $jobAppl->save();

            return response('User Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storemisc(Request $request) {
        try{
            $dataToSave = $request->validate([
                // 'token' => 'required',
                'application_id' => 'required',
                'other_benefits' => 'required',
                'work_contract' => 'required',
                'close_friend' => 'required',
                'company_knowledge' => 'required',
                'position_reason' => 'required',
                'position_knowledge' => 'required',
                'work_environment' => 'required',
                'long_plan' => 'required',
                'like_person' => 'required',
                'dislike_person' => 'required',
                'weakness' => 'required',
                'strength' => 'required',
                'leisure_time' => 'required',
                'topic' => 'required',
                'reference' => 'required',
                'reference_source' => 'required',
                'reference_connection' => 'required',
                'reference_phone' => 'required'
            ]);
            
            $data = ScreeningAnswer::where("application_id", $dataToSave['application_id'])->first();

            foreach ($dataToSave as $key => $value) {
                $data->$key = $value;
            }

            $data->save();

            $miscToSave = $request->validate([
                'residence' => 'required',
                'residence_other_name' => 'required_if:residence,==,other',
                'transportation' => 'required',
                'transportation_other_name' => 'required_if:transportation.*,in:other',
                'driver_license' => 'required',
                'credit' => 'required',
                'financial_support' => 'required',
                'chronic_illness' => 'required',
                'recurring_health_issues' => 'required',
                'work_date' => 'required',
                'benefit_expectation' => 'required',
            ]);

            $data = OtherAnswer::where("application_id", $dataToSave['application_id'])->first();

            foreach ($miscToSave as $key => $value) {
                if (is_array($value)) {
                    $value = implode(", ", $value);
                }
                if(str_contains($value, 'other')){
                    $value = str_replace('other', $miscToSave["{$key}_other_name"], $value);
                }
                if ($value && !str_contains($key, 'other')) {
                    $data->$key = $value;
                }
            }

            $data->save();

            return response('Misc Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeedu(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'name' => 'array|required',
                'location' => 'array|required',
                'enroll' => 'array|required',
                'graduate' => 'array|required',
                'major' => 'array|required',
                'degree' => 'array|required'
            ]);

            EducationBackground::where('application_id', $dataToSave['application_id'])->delete();

            for ($i=0; $i < count($dataToSave['name']); $i++) { 
                $data = new EducationBackground();
                $data->application_id = $dataToSave['application_id']; 
                $data->name = $dataToSave['name'][$i];
                $data->location = $dataToSave['location'][$i];
                $data->enroll = $dataToSave['enroll'][$i];
                $data->graduate = $dataToSave['graduate'][$i];
                $data->major = $dataToSave['major'][$i];
                $data->degree = $dataToSave['degree'][$i];
                $data->save();
            }

            return response('Education Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeworkexp(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'start' => 'array|required',
                'end' => 'array|required',
                'name' => 'array|required',
                'position' => 'array|required',
                'net_benefits' => 'array|required',
                'leave_reason' => 'array|required',
                'duties' => 'array|required'
            ]);

            WorkExperience::where('application_id', $dataToSave['application_id'])->delete();

            for ($i=0; $i < count($dataToSave['name']); $i++) { 
                $data = new WorkExperience();
                $data->application_id = $dataToSave['application_id']; 
                $data->period = "{$dataToSave['start'][$i]} - {$dataToSave['end'][$i]}";
                $data->name = $dataToSave['name'][$i];
                $data->position = $dataToSave['position'][$i];
                $data->net_benefits = $dataToSave['net_benefits'][$i];
                $data->leave_reason = $dataToSave['leave_reason'][$i];
                $data->duties = $dataToSave['duties'][$i];
                $data->save();
            }

            return response('Work Experience Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeorghist(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'name' => 'array|required',
                'position' => 'array|required',
                'duties' => 'array|required',
                'location' => 'array|required'
            ]);

            OrganizationHistory::where('application_id', $dataToSave['application_id'])->delete();

            for ($i=0; $i < count($dataToSave['name']); $i++) { 
                $data = new OrganizationHistory();
                $data->application_id = $dataToSave['application_id']; 
                $data->name = $dataToSave['name'][$i];
                $data->position = $dataToSave['position'][$i];
                $data->location = $dataToSave['location'][$i];
                $data->duties = $dataToSave['duties'][$i];
                $data->save();
            }

            return response('Organization History Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeachievement(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'achievement' => 'array|required',
                'institution' => 'array|required',
                'description' => 'array|required',
                'year' => 'array|required'
            ]);

            AchievementList::where('application_id', $dataToSave['application_id'])->delete();

            for ($i=0; $i < count($dataToSave['achievement']); $i++) { 
                $data = new AchievementList();
                $data->application_id = $dataToSave['application_id']; 
                $data->achievement = $dataToSave['achievement'][$i];
                $data->institution = $dataToSave['institution'][$i];
                $data->year = $dataToSave['year'][$i];
                $data->description = $dataToSave['description'][$i];
                $data->save();
            }

            return response('Achievement Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storefamily(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'relation' => 'array|required',
                'name' => 'array|required',
                'pdob' => 'array|required',
                'age' => 'array|required',
                'gender' => 'array|required',
                'job' => 'array|required'
            ]);

            Family::where('application_id', $dataToSave['application_id'])->delete();

            for ($i=0; $i < count($dataToSave['relation']); $i++) { 
                $data = new Family();
                $data->application_id = $dataToSave['application_id']; 
                $data->relation = $dataToSave['relation'][$i];
                $data->name = $dataToSave['name'][$i];
                $data->pdob = $dataToSave['pdob'][$i];
                $data->age = $dataToSave['age'][$i];
                $data->gender = $dataToSave['gender'][$i];
                $data->job = $dataToSave['job'][$i];
                $data->save();
            }

            return response('Family List Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $email
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeskill(Request $request) {
        try {
            $dataToSave = $request->validate([
                'application_id' => 'required',
                'skill' => 'required',
                'specification' => 'required',
                'level' => 'required',
            ]);

            SkillList::where('application_id', $dataToSave['application_id'])->whereNotIn('id', $request['id'])->delete();

            for ($i=0; $i < count($dataToSave['skill']); $i++) { 
                if (isset($request['id'][$i])) {
                    $data = SkillList::where('id', $request['id'][$i])->first();
                    $data->application_id = $dataToSave['application_id']; 
                    $data->skill = $dataToSave['skill'][$i];
                    $data->specification = $dataToSave['specification'][$i];
                    $data->level = $dataToSave['level'][$i];
                    if (isset($request['certificate'][$i])) {
                        $imageName = time().'.'.$request['certificate'][$i]->extension();  
                        $request['certificate'][$i]->move(public_path('images'), $imageName);
                        $data->certificate = "/images/{$imageName}";
                    }
                    $data->save();
                }else{
                    $data = new SkillList();
                    $data->application_id = $dataToSave['application_id']; 
                    $data->skill = $dataToSave['skill'][$i];
                    $data->specification = $dataToSave['specification'][$i];
                    $data->level = $dataToSave['level'][$i];
                    if (isset($request['certificate'][$i])) {
                        $imageName = time().'.'.$request['certificate'][$i]->extension();  
                        $request['certificate'][$i]->move(public_path('images'), $imageName);
                        $data->certificate = "/images/{$imageName}";
                    }
                    $data->save();
                }
            }

            return response('Skill List Data Saved');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }
}
