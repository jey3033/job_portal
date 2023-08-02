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
        return view('profile', ['data' => $data]);
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
            if ($dataToSave['profile_path']) {
                $imageName = time().'.'.$dataToSave['profile_path']->extension();  
                $dataToSave['profile_path']->move(public_path('images'), $imageName);
                $jobAppl->profile_path = "/images/{$imageName}";
            }
            $jobAppl->birthdate = $dataToSave['birthdate'];
            $jobAppl->religion = $dataToSave['religion'];
            $jobAppl->race = $dataToSave['race'];
            $jobAppl->phone_number = $dataToSave['phone_number'];
            $jobAppl->address = $dataToSave['address'];
            $jobAppl->real_address = $dataToSave['real_address'];
            // $jobAppl->profile_path = $dataToSave['profile_path'];
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
