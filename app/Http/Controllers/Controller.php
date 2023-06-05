<?php

namespace App\Http\Controllers;

use App\Charts\jobChart;
use App\Models\BackendUser;
use App\Models\JobApply;
use App\Models\JobOpening;
use App\Models\User;
use App\Policies\JobOpeningPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login() {
        if (Auth::user()) return redirect('/dashboard');
        return view('login');
    }

    public function dashboard() {
        if (!Auth::user()) return redirect('/');

        $active_job = JobOpening::where('active',0);
        
        if (Auth::user()->backend) {

            $chart = new jobChart;
            $failed = JobOpening::where('active',2)->count();
            $success = JobOpening::where('active',1)->count();
            $onprogress = JobOpening::where('active',0)->count();

            $chart->labels(['On Progress', 'Success', 'Failed']);
            $chart->dataset('total', 'bar', [$onprogress, $success, $failed]);
            $chart->height(100);
            // dd($active_job);
            return view('dashboard', ['active_job' => $active_job->paginate(), 'job_report' => $chart]);
        }
        $applied_job = JobApply::where('user_id', Auth::user()->id)->select('job_id')->get();
        $applied_job_id = [];

        foreach ($applied_job as $key => $value) {
            $applied_job_id[] = $value->job_id;
        }
        if(!empty($applied_job_id)) {
            $str_applied_job_id = '('.implode(",", $applied_job_id).')';

            $active_job = $active_job->whereRaw("id NOT IN $str_applied_job_id");
        }
        return view('fedashboard', ['active_job' => $active_job->paginate()]);
    }

    public function auth() {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            Auth::login(Auth::user());
            if (Auth::user()->backend) {
                return response('login backend success', 200);
            }
            return response('login success', 200);
        }else{
            return response("user not found", 422);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function register() {
        return view('userregistration');
    }

    public function frontendregister() {
        try {
            $user = new User();
            $user->name = $_POST['nama'];
            $user->email = $_POST['email'];
            $user->ktp = $_POST['ktp'];
            $user->password = bcrypt($_POST['password']);
            $user->backend = 0;

            $user->save();

            return response('user created');
        } catch (\Throwable $th) {
            //throw $th;
            return response($th->getMessage(),422);
        }
    }
}
