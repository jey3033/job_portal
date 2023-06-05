<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;
use App\Http\Requests\StoreJobOpeningRequest;
use App\Http\Requests\UpdateJobOpeningRequest;
use App\Models\JobApply;
use Illuminate\Support\Facades\Auth;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
        if (!Auth::user()) return redirect('/');

        $limit = (isset($_POST['limit'])) ? $_POST['limit'] : 5;

        $data = JobOpening::paginate($limit);

        return view('jobindex', ['job_data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::user()) return redirect('/');
        return view('jobcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJobOpeningRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobOpeningRequest $request)
    {
        //
        try {
            $data = $request->validated();
            $new = new JobOpening();
            $new->title = $data['jobname'];
            $new->description = $data['jobdesc'];
            $new->qualification = $data['jobqual'];
            $new->job_path = md5(rand() . $data['jobname'] . rand());
            $new->author = Auth::user()->id;
            $new->active = 0;

            $new->save();

            return response("Job {$data['jobname']} saved");
        } catch (\Throwable $th) {
            //throw $th;
            return response($th->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(String $uuid)
    {
        if (!Auth::user()) return redirect('/');
        
        $job = JobOpening::where('job_path', $uuid)->first();
        $userid = Auth::user()->id;

        $check = JobApply::whereRaw("job_id = $job->id AND user_id = $userid");
        return view('jobdetail', ['job_data' => $job, 'check' => $check]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(String $uuid)
    {
        //
        if (!Auth::user()) return redirect('/');
        
        $job = JobOpening::where('job_path', $uuid)->first();
        return view('jobedit', ['job_data' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobOpeningRequest  $request
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(String $uuid, UpdateJobOpeningRequest $request) {
        try {
            $data = $request->validated();

            $dataToEdit = JobOpening::where('job_path', $uuid)->first();
            $dataToEdit->title = $data['jobname'];
            $dataToEdit->description = $data['jobdesc'];
            $dataToEdit->qualification = $data['jobqual'];
            $dataToEdit->save();

            return response('data Editted');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 402);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function deactivate(String $uuid) {
        try {
            $dataToDeact = JobOpening::where('job_path', $uuid)->first();
            $dataToDeact->active = 2;
            $dataToDeact->save();

            return response('data deactivatted');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 402);
        }
    }

    public function activate(String $uuid) {
        try {
            $dataToAct = JobOpening::where('job_path', $uuid)->first();
            $dataToAct->active = 0;
            $dataToAct->save();
            
            return response('data activated');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 402);
        }
    }

    public function done(String $uuid) {
        try {
            $dataToAct = JobOpening::where('job_path', $uuid)->first();
            $dataToAct->active = 1;
            $dataToAct->save();

            return response('job opening is fullfiled');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 402);
        }
    }

    public function apply(String $uuid) {
        try {
            $jobData = JobOpening::where('job_path', $uuid)->first();
            $apply = new JobApply();
            $apply->user_id = Auth::user()->id;
            $apply->job_id = $jobData->id;

            $apply->save();

            return response('job applied');
        } catch (\Throwable $th) {
            return response($th->getMessage(), 402);
        }
    }

    public function applied() {
        
        $applied_job = JobApply::where('user_id', Auth::user()->id)->select('job_id')->get();
        $applied_job_id = [];

        foreach ($applied_job as $key => $value) {
            $applied_job_id[] = $value->job_id;
        }
        $str_applied_job_id = '('.implode(",", $applied_job_id).')';

        $job = JobOpening::whereRaw("id IN $str_applied_job_id")->paginate();

        return view('jobindex', ['job_data' => $job]);
    }

    public function get_active() {
        return JobOpening::where('active',0)->paginate();
    }
}
