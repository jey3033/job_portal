<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;

    public function applier() {
        $dataApplier = JobApply::where('job_id', $this->id)->select('user_id')->get();
        $idApplier = [];
        foreach ($dataApplier as $key => $value) {
            $idApplier[] = $value['user_id'];
        }
        $strIdApplier = '('.implode(",", $idApplier).')';

        $Applier = User::whereRaw("id IN $strIdApplier")->get();

        return $Applier;
    }
}
