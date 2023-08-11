<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\User;
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
        // dd(Auth::user());
        if (JobApplication::where("user_id", Auth::user()->id)->count() > 0) {
            $data = JobApplication::where("user_id", Auth::user()->id)->first();
            // dd($data);
        }else {
            $data->user_id = Auth::user()->id;
            $data->save();
        }
        return view('profile', ['data' => $data, 'Title' => "Biodata Anda"]);
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
            // dd($request);
            $dataToSave = $request->validated();
            // 
            // $userId = User::where("email", $dataToSave['email'])->first()->user_id;
            $jobAppl = JobApplication::where("user_id", Auth::user()->id)->first();

            $jobAppl->user_short_desc = trim($dataToSave['user_short_desc']);
            // var_dump($dataToSave['user_short_desc']);die();
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
}
