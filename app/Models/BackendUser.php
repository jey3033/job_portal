<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackendUser extends Model
{
    use HasFactory;

    public function JobOpening() {
        return JobOpening::where("author", $this->user_path)->get();
    }
}
