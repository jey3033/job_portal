<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Profile</title>

    @include('include/head')
    <style>
        .select2 {
            padding-right: unset;
            padding-left: unset;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-right: 0px;
        }
    </style>
</head>
<body>
    @include('include/navigation')
    
    @if (!Auth::user()->backend)
    <div class="card row mx-4" style="margin-top:74px">
        <div class="card-header fs-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="biodata" aria-current="page" href="#" onclick="showCard('biodata')">Biodata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="education" href="#" onclick="showCard('education')">Data Pendidikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="workexp" href="#" onclick="showCard('workexp')">Pengalaman Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orghist" href="#" onclick="showCard('orghist')">Pengalaman Organisasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="skills" href="#" onclick="showCard('skills')">Keterampilan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="achievement" href="#" onclick="showCard('achievement')">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="family" href="#" onclick="showCard('family')">Keluarga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="misc" href="#" onclick="showCard('misc')">Lain Lain</a>
                </li>
            </ul>
        </div>
        <div class="card-body" id="biodata-card">
            <form id="biodata-form" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    {{-- {{$data}} --}}
                    <img src="{{ $data->profile_path }}" alt="Profile Photo" class="img-fluid mb-3 prof-photo d-block" id="prof-photo">
                    <div class="mb-3 row">
                        <label for="Image" class="form-label col-2 text-end align-self-center mb-0">Profile</label>
                        <input class="form-control col-8" name="profile_path" type="file" id="profile_path" onchange="preview()">
                        <button role="button" onclick="clearImage()" class="btn btn-danger col-1 align-self-center mb-0 ms-1"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    </div>
                </div>
                <div class="text-center mb-3" id="preview_image">
                    <img id="frame" src="" class="img-fluid mt-3 prev-image" />
                </div>
                <div class="mb-3 row">
                    <label for="user_short_desc" class="form-label col-2 text-end align-self-center mb-0">Deskripsi Singkat</label>
                    <textarea class="form-control col" placeholder="Jelaskan mengenai diri anda secara singkat" name="user_short_desc" id="user_short_desc" rows="3">
                        {{ $data->get_user_short_desc() }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                    <label for="birthplace" class="form-label col-2 text-end align-self-center mb-0">Kota Lahir</label>
                    <input type="text" class="form-control col-4" name="birthplace" id="birthplace" placeholder="kota lahir" value="{{ $data->birthplace }}">
                    <label for="birthdate" class="form-label col-2 text-end align-self-center mb-0">Tanggal Lahir</label>
                    <input type="date" class="form-control col-4" name="birthdate" id="birthdate" placeholder="tanggal lahir" value="{{ $data->birthdate }}">
                </div>
                <div class="mb-3 row">
                    <label for="id_city" class="form-label col-2 text-end align-self-center mb-0">Kota Cetak KTP</label>
                    <input type="text" class="form-control col" name="id_city" id="id_city" placeholder="kota cetak KTP" value="{{ $data->id_city }}">
                </div>
                <div class="mb-3 row">
                    <label for="tax_number" class="form-label col-2 text-end align-self-center mb-0">Nomor NPWP</label>
                    <input type="text" class="form-control col" name="tax_number" id="tax_number" placeholder="nomor NPWP" value="{{ $data->tax_number }}">
                </div>
                <div class="mb-3 row">
                    <label for="religion" class="form-label col-2 text-end align-self-center mb-0">Agama</label>
                    <select name="religion" id="religion" class="form-control select2 col-4" placeholder="Pilih Agama">
                        <option value=""></option>
                        <option value="Islam"
                        @if ($data->religion == 'Islam')
                            selected
                        @endif 
                        > Islam</option>
                        <option value="Kristen"
                        @if ($data->religion == 'Kristen')
                            selected
                        @endif 
                        > Kristen</option>
                        <option value="Katolik"
                        @if ($data->religion == 'Katolik')
                            selected
                        @endif
                        > Katolik</option>
                        <option value="Hindu"
                        @if ($data->religion == 'Hindu')
                            selected
                        @endif
                        > Hindu</option>
                        <option value="Buddha"
                        @if ($data->religion == 'Buddha')
                            selected
                        @endif
                        > Buddha</option>
                        <option value="Kong Hu Cu"
                        @if ($data->religion == 'Kong Hu Cu')
                            selected
                        @endif
                        > Kong Hu Cu</option>
                    </select>
                    <label for="gender" class="form-label col-2 text-end align-self-center mb-0">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control gender col-4" placeholder="Pilih Jenis Kelamin">
                        <option value=""></option>
                        <option value="Pria"
                        @if ($data->gender == 'Pria')
                            selected
                        @endif 
                        > Pria</option>
                        <option value="Wanita"
                        @if ($data->gender == 'Wanita')
                            selected
                        @endif 
                        > Wanita</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <label for="marital_status" class="form-label col-2 text-end align-self-center mb-0">Status Pernikahan</label>
                    <select name="marital_status" id="marital_status" class="form-control select2 col-4" placeholder="Pilih Status Pernikahan">
                        <option value=""></option>
                        <option value="Lajang"
                        @if ($data->marital_status == 'Lajang')
                            selected
                        @endif 
                        > Lajang</option>
                        <option value="Menikah"
                        @if ($data->marital_status == 'Menikah')
                            selected
                        @endif 
                        > Menikah</option>
                        <option value="Duda"
                        @if ($data->marital_status == 'Duda')
                            selected
                        @endif
                        > Duda</option>
                        <option value="Janda"
                        @if ($data->marital_status == 'Janda')
                            selected
                        @endif
                        > Janda</option>
                    </select>
                    <label for="wedding_date" class="form-label col-2 text-end align-self-center mb-0 depend-marital_status">Tanggal Menikah</label>
                    <input type="date" class="form-control col depend-marital_status" name="wedding_date" id="wedding_date" placeholder="tanggal lahir" value="{{ $data->wedding_date }}">
                </div>
                <div class="mb-3 row">
                    <label for="blood_type" class="form-label col-2 text-end align-self-center mb-0">Golongan Darah</label>
                    <select name="blood_type" id="blood_type" class="form-control select2 col-2" placeholder="Pilih Golongan Darah">
                        <option value=""></option>
                        <option value="O"
                        @if ($data->blood_type == 'O')
                            selected
                        @endif 
                        > O</option>
                        <option value="A"
                        @if ($data->blood_type == 'A')
                            selected
                        @endif 
                        > A</option>
                        <option value="B"
                        @if ($data->blood_type == 'B')
                            selected
                        @endif
                        > B</option>
                        <option value="AB"
                        @if ($data->blood_type == 'AB')
                            selected
                        @endif
                        > AB</option>
                    </select>
                    <label for="height" class="form-label col-2 text-end align-self-center mb-0">Tinggi Badan(CM)</label>
                    <input type="number" class="col-2 form-control" name="height" id="height" placeholder="Tinggi(dalam CM)" value="{{ $data->height }}">
                    <label for="weight" class="form-label col-2 text-end align-self-center mb-0">Berat Badan(KG)</label>
                    <input type="number" class="col-2 form-control" name="weight" id="weight" placeholder="Berat(dalam KG)" value="{{ $data->weight }}">
                </div>
                <div class="mb-3 row">
                    <label for="race" class="form-label col-2 text-end align-self-center mb-0">Suku</label>
                    <input type="text" class="form-control col" name="race" id="race" placeholder="Suku" value="{{ $data->race }}">
                </div>
                <div class="mb-3 row">
                    <label for="phone_number" class="form-label col-2 text-end align-self-center mb-0">No. HP</label>
                    <input type="number" class="col-4 form-control" name="phone_number" id="phone_number" placeholder="No. HP" value="{{ $data->phone_number }}">
                    <label for="residence_phone" class="form-label col-2 text-end align-self-center mb-0">No. Telp Rumah</label>
                    <input type="number" class="col-4 form-control" name="residence_phone" id="residence_phone" placeholder="No. Telp Rumah" value="{{ $data->residence_phone }}">
                </div>
                <div class="mb-3 row">
                    <label for="real_address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap domisili</label>
                    <textarea class="form-control col" placeholder="Alamat lengkap domisili" name="real_address" id="real_address" rows="3">
                        {{ trim($data->real_address, " ") }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap sesuai ktp</label>
                    <textarea class="form-control col" placeholder="Alamat lengkap sesuai ktp" name="address" id="address" rows="3">
                        {{ $data->address }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                    <label for="facebook" class="form-label col-2 text-end align-self-center mb-0">Facebook</label>
                    <input type="text" class="form-control col" name="facebook" id="facebook" placeholder="Alamat Facebook anda" value="{{ $data->facebook }}">
                </div>
                <div class="mb-3 row">
                    <label for="twitter" class="form-label col-2 text-end align-self-center mb-0">Twitter</label>
                    <input type="text" class="form-control col" name="twitter" id="twitter" placeholder="Alamat Twitter anda" value="{{ $data->twitter }}">
                </div>
                <div class="mb-3 row">
                    <label for="instagram" class="form-label col-2 text-end align-self-center mb-0">Instagram</label>
                    <input type="text" class="form-control col" name="instagram" id="instagram" placeholder="Alamat Instagram anda" value="{{ $data->instagram }}">
                </div>
                <div class="mb-3 row">
                    <label for="linkedin" class="form-label col-2 text-end align-self-center mb-0">Linkedin</label>
                    <input type="text" class="form-control col" name="linkedin" id="linkedin" placeholder="Alamat Linkedin Anda" value="{{ $data->linkedin }}">
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-btn">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="education-card">
            <button class="float-end btn btn-primary" id="education-add-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Add
            </button>
            <form id="education-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="education-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-md-2 col-head">Nama Instansi</div>
                        <div class="col-md-4 col-head">Lokasi</div>
                        <div class="col-md-1 col-head">Mulai</div>
                        <div class="col-md-1 col-head">Selesai</div>
                        <div class="col-md-2 col-head">Jurusan</div>
                        <div class="col-md-1 col-head">Gelar</div>
                    </div>
                    @forelse ($education_background as $item)
                    <div class="row">
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama Instansi" value="{{ $item->name }}">
                        </div>
                        <div class="col-md-4 col-data">
                            <input class="form-control" type="text" name="location[]" placeholder="Lokasi" value="{{ $item->location }}">
                        </div>
                        <div class="col-md-1 col-data">
                            <select class="form-control monthyearpicker" name="enroll[]" value="{{ $item->enroll }}">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-1 col-data">
                            <select class="form-control monthyearpicker" name="graduate[]" value="{{ $item->graduate }}">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="major[]" placeholder="Jurusan" value="{{ $item->major }}">
                        </div>
                        <div class="col-md-1 col-data">
                            <input class="form-control" type="text" name="degree[]" placeholder="Gelar" value="{{ $item->degree }}">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-edu">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="workexp-card">
            <button class="float-end btn btn-primary" id="workexp-add-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Add
            </button>
            <form id="workexp-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="workexp-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-1half col-head">Awal</div>
                        <div class="col-1half col-head">Selesai</div>
                        <div class="col-md-2 col-head">Nama Perusahaan</div>
                        <div class="col-md-2 col-head">Jabatan</div>
                        <div class="col-md-2 col-head">Gaji & Fasilitas</div>
                        <div class="col-md-2 col-head">Alasan Berhenti</div>
                    </div>
                    @forelse ($work_experience as $item)
                        <div class="row">
                            <div class="col-1half col-data">
                                <select class="form-control monthyearpicker" name="start[]" value="{{ explode(' - ',$item->period)[0] }}">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-1half col-data">
                                <select class="form-control monthyearpicker" name="end[]" value="{{ explode(' - ',$item->period)[1] }}">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="name[]" placeholder="Nama Perusahaan" value="{{$item->name}}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="position[]" placeholder="Jabatan" value="{{$item->position}}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="net_benefits[]" placeholder="Gaji dan Fasilitas" value="{{$item->net_benefits}}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="leave_reason[]" placeholder="Alasan Berhenti" value="{{$item->leave_reason}}">
                            </div>
                            <div class="col-md-1 col-data text-white">
                                <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                            <div class="col-md-12 col-data">
                                <textarea class="form-control" name="duties[]" placeholder="Tugas"> {{$item->duties}}</textarea>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-workexp">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="orghist-card">
            <button class="float-end btn btn-primary" id="orghist-add-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Add
            </button>
            <form id="orghist-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="orghist-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-md-3 col-head">Nama Organisasi</div>
                        <div class="col-md-2 col-head">Posisi</div>
                        <div class="col-md-3 col-head">Tugas</div>
                        <div class="col-md-3 col-head">Lokasi</div>
                    </div>
                    @forelse ($organization_history as $item)
                        <div class="row">
                            <div class="col-md-3 col-data">
                                <input class="form-control" type="text" name="name[]" placeholder="Nama Organisasi" value="{{ $item->name }}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="position[]" placeholder="Posisi" value="{{ $item->position }}">
                            </div>
                            <div class="col-md-3 col-data">
                                <input class="form-control" type="text" name="duties[]" placeholder="Tugas" value="{{ $item->duties }}">
                            </div>
                            <div class="col-md-3 col-data">
                                <input class="form-control" type="text" name="location[]" placeholder="Lokasi" value="{{ $item->locationname }}">
                            </div>
                            <div class="col-md-1 col-data text-white">
                                <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-orghist">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="skills-card">
            <button class="float-end btn btn-primary" id="skill-add-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Add
            </button>
            <form id="skill-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="skill-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-md-3 col-head">Keterampilan</div>
                        <div class="col-md-3 col-head">Jenis Keterampilan</div>
                        <div class="col-md-2 col-head">Level</div>
                        <div class="col-md-3 col-head">Sertifikasi</div>
                    </div>
                    @forelse ($skill_list as $item)
                        <div class="row">
                            <div class="col-md-3 align-self-center col-data">
                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                <input class="form-control" type="text" name="skill[]" placeholder="Ketrampilan" value="{{ $item->skill }}">
                            </div>
                            <div class="col-md-3 align-self-center col-data">
                                <input class="form-control" type="text" name="specification[]" placeholder="Lembaga" value="{{ $item->specification }}">
                            </div>
                            <div class="col-md-2 align-self-center col-data">
                                <input class="form-range" type="range" name="level[]" placeholder="Level" min="1" max="3" value="{{ $item->level }}">
                            </div>
                            <div class="col-md-3 align-self-center col-data">
                                <img src="{{ $item->certificate }}" alt="Certificate Photo" class="img-fluid mb-3 d-block">
                                <input class="form-control col-12 d-inline" name="certificate[]" type="file" onchange="previewNext()">
                                {{-- <input class="form-control" type="file" name="certificate[]" placeholder="Sertifikat" value="{{ $item->certificate }}"> --}}
                            </div>
                            <div class="col-md-1 align-self-center col-data text-white">
                                <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-skill">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="achievement-card">
            <button class="float-end btn btn-primary" id="achievement-add-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Add
            </button>
            <form id="achievement-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="achievement-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-md-3 col-head">Prestasi yang dicapai</div>
                        <div class="col-md-3 col-head">Lembaga</div>
                        <div class="col-md-1 col-head">Tahun</div>
                        <div class="col-md-4 col-head">Keterangan</div>
                    </div>
                    @forelse ($achievement_list as $item)
                        <div class="row">
                            <div class="col-md-3 col-data">
                                <input class="form-control" type="text" name="achievement[]" placeholder="Prestasi yang dicapai" value="{{ $item->achievement }}">
                            </div>
                            <div class="col-md-3 col-data">
                                <input class="form-control" type="text" name="institution[]" placeholder="Lembaga" value="{{ $item->institution }}">
                            </div>
                            <div class="col-md-1 col-data">
                                <select class="form-control yearpicker" name="year[]" value="{{ $item->year }}">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4 col-data">
                                <input class="form-control" type="text" name="description[]" placeholder="Keterangan" value="{{ $item->description }}">
                            </div>
                            <div class="col-md-1 col-data text-white">
                                <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-achievement">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="family-card">
            <button class="float-end btn btn-primary" id="family-add-sibling-row">
                <i class="fa-solid fa-circle-plus me-1"></i>Tambah Saudara
            </button>
            @if ($data->marital_status != 'Lajang')
                <button class="float-end btn btn-primary" id="family-add-child-row">
                    <i class="fa-solid fa-circle-plus me-1"></i>Tambah Anak
                </button>
            @endif
            <form id="family-form">
                @csrf
                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <div id="family-table-container" style="clear: both">
                    <div class="row">
                        <div class="col-md-1 col-head">Hubungan</div>
                        <div class="col-md-2 col-head">Nama</div>
                        <div class="col-md-2 col-head">Tempat, Tanggal Lahir</div>
                        <div class="col-md-2 col-head">Usia</div>
                        <div class="col-md-2 col-head">Jenis Kelamin</div>
                        <div class="col-md-2 col-head">Pekerjaan</div>
                    </div>
                    <div id="up-family">
                    @forelse ($family as $item)
                        @if (in_array($item->relation, ['Ayah', 'Ibu', 'Saudara']))
                        <div class="row">
                            <div class="col-md-1 col-data">
                                <input class="form-control" type="text" name="relation[]" value="{{ $item->relation }}" readonly>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="name[]" placeholder="Nama" value="{{ $item->name }}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir" value="{{ $item->pdob }}">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="number" name="age[]" placeholder="Usia" value="{{ $item->age }}">
                            </div>
                            <div class="col-md-2 col-data">
                                @if ($item->relation == 'Ayah')
                                    <input class="form-control" type="text" name="gender[]" value="Pria" readonly>
                                @elseif ($item->relation == 'Ibu')
                                    <input class="form-control" type="text" name="gender[]" value="Wanita" readonly>
                                @else
                                    <select name="gender[]" class="form-control gender col-4" placeholder="Pilih Jenis Kelamin">
                                        <option value=""></option>
                                        <option value="Pria"
                                        @if ($item->gender == "Pria")
                                            selected
                                        @endif
                                        >Pria</option>
                                        <option value="Wanita"
                                        @if ($item->gender == "Wanita")
                                            selected
                                        @endif
                                        >Wanita</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan" value="{{ $item->job }}">
                            </div>
                        </div>
                        @endif
                    @empty
                        <div class="row">
                            <div class="col-md-1 col-data">
                                <input class="form-control" type="text" name="relation[]" value="Ayah" readonly>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="name[]" placeholder="Nama">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="number" name="age[]" placeholder="Usia">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="gender[]" value="Pria" readonly>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-data">
                                <input class="form-control" type="text" name="relation[]" value="Ibu" readonly>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="name[]" placeholder="Nama">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="number" name="age[]" placeholder="Usia">
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="gender[]" value="Wanita" readonly>
                            </div>
                            <div class="col-md-2 col-data">
                                <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan">
                            </div>
                        </div>
                    @endforelse
                    </div>
                    <div class="main-family">
                    @forelse ($family as $item)
                    @if (in_array($item->relation, ['Suami', 'Istri', 'Anak']))
                    <div class="row">
                        <div class="col-md-1 col-data">
                            <input class="form-control" type="text" name="relation[]" value="{{ $item->relation }}" readonly>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama" value="{{ $item->name }}">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir" value="{{ $item->pdob }}">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="number" name="age[]" placeholder="Usia" value="{{ $item->age }}">
                        </div>
                        <div class="col-md-2 col-data">
                            @if ($item->relation == 'Suami')
                                <input class="form-control" type="text" name="gender[]" value="Pria" readonly>
                            @elseif ($item->relation == 'Istri')
                                <input class="form-control" type="text" name="gender[]" value="Wanita" readonly>
                            @else
                                <select name="gender[]" class="form-control gender col-4" placeholder="Pilih Jenis Kelamin">
                                    <option value=""></option>
                                    <option value="Pria"
                                    @if ($item->gender == "Pria")
                                        selected
                                    @endif
                                    >Pria</option>
                                    <option value="Wanita"
                                    @if ($item->gender == "Wanita")
                                        selected
                                    @endif
                                    >Wanita</option>
                                </select>
                            @endif
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan" value="{{ $item->job }}">
                        </div>
                    </div>
                    @endif
                    @empty
                        @if ($data->marital_status != 'Lajang')
                            <div id="main-family">
                                <div class="row">
                                    <div class="col-md-1 col-data">
                                        @if ($data->gender == 'Pria')
                                            <input class="form-control" type="text" name="relation[]" value="Istri" readonly>
                                        @elseif ($data->gender == 'Wanita')
                                            <input class="form-control" type="text" name="relation[]" value="Suami" readonly>
                                        @else
                                            <input class="form-control" type="text" name="relation[]">
                                        @endif
                                    </div>
                                    <div class="col-md-2 col-data">
                                        <input class="form-control" type="text" name="name[]" placeholder="Nama">
                                    </div>
                                    <div class="col-md-2 col-data">
                                        <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir">
                                    </div>
                                    <div class="col-md-2 col-data">
                                        <input class="form-control" type="number" name="age[]" placeholder="Usia">
                                    </div>
                                    <div class="col-md-2 col-data">
                                        @if ($data->gender == 'Pria')
                                            <input class="form-control" type="text" name="gender[]" value="Wanita" readonly>
                                        @elseif ($data->gender == 'Wanita')
                                            <input class="form-control" type="text" name="gender[]" value="Pria" readonly>
                                        @else
                                            <select name="gender[]" class="form-control gender col-4" placeholder="Pilih Jenis Kelamin">
                                                <option value=""></option>
                                                <option value="Pria"> Pria</option>
                                                <option value="Wanita"> Wanita</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-2 col-data">
                                        <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforelse
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-family">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-body" id="misc-card">
            <form id="misc-form">
                @csrf
                <div class="mb-3 row">
                    <input type="hidden" name="application_id" value="{{ $data->id }}">
                    <label for="other_benefits" class="form-label col-2 text-start align-self-center mb-0">1. Sebutkan benefit dari perusahaan lain jika ada (incentive, bonus, kendaraan dinas, pulsa/HP)</label>
                    <input type="text" class="form-control col" name="other_benefits" id="other_benefits" placeholder="" value="{{ $screening_answer->other_benefits }}">
                </div>
                <div class="mb-3 row">
                    <label for="work_contract" class="form-label col-2 text-start align-self-center mb-0">2. Apakah Anda saat ini terikat kontrak kerja?</label>
                    <input type="text" class="form-control col" name="work_contract" id="work_contract" placeholder="" value="{{ $screening_answer->work_contract }}">
                </div>
                <div class="mb-3 row">
                    <label for="close_friend" class="form-label col-2 text-start align-self-center mb-0">3. Bila Anda menghadapi persoalan pribadi / pekerjaan, dengan siapakah biasanya Anda berdiskusi dan Mengapa?</label>
                    <input type="text" class="form-control col" name="close_friend" id="close_friend" placeholder="" value="{{ $screening_answer->close_friend }}">
                </div>
                <div class="mb-3 row">
                    <label for="company_knowledge" class="form-label col-2 text-start align-self-center mb-0">4. Apa yang Anda ketahui tentang Perusahaan kami?</label>
                    <input type="text" class="form-control col" name="company_knowledge" id="company_knowledge" placeholder="" value="{{ $screening_answer->company_knowledge }}">
                </div>
                <div class="mb-3 row">
                    <label for="position_reason" class="form-label col-2 text-start align-self-center mb-0">5. Mengapa Anda ingin bekerja pada jabatan yang Anda lamar?</label>
                    <input type="text" class="form-control col" name="position_reason" id="position_reason" placeholder="" value="{{ $screening_answer->position_reason }}">
                </div>
                <div class="mb-3 row">
                    <label for="position_knowledge" class="form-label col-2 text-start align-self-center mb-0">6.	Apa yang Anda ketahui tentang jabatan tersebut?</label>
                    <input type="text" class="form-control col" name="position_knowledge" id="position_knowledge" placeholder="" value="{{ $screening_answer->position_knowledge }}">
                </div>
                <div class="mb-3 row">
                    <label for="work_environment" class="form-label col-2 text-start align-self-center mb-0">7. Lingkungan pekerjaan seperti apa yang paling Anda sukai?</label>
                    <input type="text" class="form-control col" name="work_environment" id="work_environment" placeholder="" value="{{ $screening_answer->work_environment }}">
                </div>
                <div class="mb-3 row">
                    <label for="long_plan" class="form-label col-2 text-start align-self-center mb-0">8. Tuliskan rencana Anda dalam 5 tahun mendatang?</label>
                    <input type="text" class="form-control col" name="long_plan" id="long_plan" placeholder="" value="{{ $screening_answer->long_plan }}">
                </div>
                <div class="mb-3 row">
                    <label for="like_person" class="form-label col-2 text-start align-self-center mb-0">9. Tipe orang bagaimana yang paling Anda senangi?</label>
                    <input type="text" class="form-control col" name="like_person" id="like_person" placeholder="" value="{{ $screening_answer->like_person }}">
                </div>
                <div class="mb-3 row">
                    <label for="dislike_person" class="form-label col-2 text-start align-self-center mb-0">10. Tipe orang bagaimana yang paling Anda tidak sukai?</label>
                    <input type="text" class="form-control col" name="dislike_person" id="dislike_person" placeholder="" value="{{ $screening_answer->dislike_person }}">
                </div>
                <div class="mb-3 row">
                    <label for="weakness" class="form-label col-2 text-start align-self-center mb-0">11. Sebutkan beberapa kekurangan yang Anda miliki sehubungan dengan jabatan yang dilamar.</label>
                    <input type="text" class="form-control col" name="weakness" id="weakness" placeholder="" value="{{ $screening_answer->weakness }}">
                </div>
                <div class="mb-3 row">
                    <label for="strength" class="form-label col-2 text-start align-self-center mb-0">12. Sebutkan beberapa kelebihan yang Anda miliki sehubungan dengan jabatan yang dilamar</label>
                    <input type="text" class="form-control col" name="strength" id="strength" placeholder="" value="{{ $screening_answer->strength }}">
                </div>
                <div class="mb-3 row">
                    <label for="leisure_time" class="form-label col-2 text-start align-self-center mb-0">13. Bagaimana cara Anda mengisi waktu luang?</label>
                    <input type="text" class="form-control col" name="leisure_time" id="leisure_time" placeholder="" value="{{ $screening_answer->leisure_time }}">
                </div>
                <div class="mb-3 row">
                    <label for="topic" class="form-label col-2 text-start align-self-center mb-0">14.	Topik/artikel apa yang Anda senangi?</label>
                    <input type="text" class="form-control col" name="topic" id="topic" placeholder="" value="{{ $screening_answer->topic }}">
                </div>
                <div class="mb-3 row">
                    <label for="reference" class="form-label col-2 text-start align-self-center mb-0">15.	Apakah kami dapat meminta referensi mengenai pekerjaan Anda terdahulu? </label>
                    <input type="text" class="form-control col" name="reference" id="reference" placeholder="" value="{{ $screening_answer->reference }}">
                </div>
                <div class="mb-3 row">
                    <label for="reference_source" class="form-label col-2 text-start align-self-center mb-0">16.	Dari mana kami dapat memperoleh referensi tentang kerja Anda?</label>
                    <input type="text" class="form-control col" name="reference_source" id="reference_source" placeholder="" value="{{ $screening_answer->reference_source }}">
                </div>
                <div class="mb-3 row">
                    <label for="reference_connection" class="form-label col-2 text-start align-self-center mb-0">17.	Sebutkan nama dan hubungan dengan Anda dengan pemberi referensi?</label>
                    <input type="text" class="form-control col" name="reference_connection" id="reference_connection" placeholder="" value="{{ $screening_answer->reference_connection }}">
                </div>
                <div class="mb-3 row">
                    <label for="reference_phone" class="form-label col-2 text-start align-self-center mb-0">18. Sebutkan nomor telepon pemberi referensi?</label>
                    <input type="text" class="form-control col" name="reference_phone" id="reference_phone" placeholder="" value="{{ $screening_answer->reference_phone }}">
                </div>
                <div class="mb-3 row">
                    <label for="residence" class="form-label col-2 text-start align-self-center mb-0">19. Tempat tinggal</label>
                    <div class="form-check col">
                        <input class="form-check-input residence" name="residence" type="radio" value="private" id="private_residence"
                        @if ($misc_answer->residence == 'private')
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="private_residence">
                            Rumah Pribadi
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input residence" name="residence" type="radio" value="parent" id="parent_residence"
                        @if ($misc_answer->residence == 'parent')
                            checked
                        @endif>
                        <label class="form-check-label" for="parent_residence">
                            Rumah Orang Tua
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input residence" name="residence" type="radio" value="lease" id="lease"
                        @if ($misc_answer->residence == 'lease')
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="lease">
                            Kontrak
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input residence" name="residence" type="radio" value="kos" id="homestay"
                        @if ($misc_answer->residence == 'kos')
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="homestay">
                            Kost
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input residence" name="residence" type="radio" value="other" id="residence_other"
                        @if ($misc_answer->residence == 'other')
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="residence_other">
                            <input class="form-input" id="residence_other_name" name="residence_other_name"
                            @if (str_contains($misc_answer->residence, 'other'))
                                value="{{$misc_answer->residence_other_name}}"
                            @endif
                            >
                        </label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="transportation" class="form-label col-2 text-start align-self-center mb-0">20. Kendaraan apa yang dipergunakan untuk bekerja ?</label>
                    {{-- <input type="text" class="form-control col" name="reference_phone" id="reference_phone" placeholder="" value="{{ $screening_answer->reference_phone }}"> --}}
                    <div class="form-check col">
                        <input class="form-check-input transportation" name="transportation[]" type="checkbox" value="car" id="car"
                        @if (str_contains($misc_answer->transportation, 'car'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="car">
                            Mobil
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input transportation" name="transportation[]" type="checkbox" value="motorcycle" id="motorcycle"
                        @if (str_contains($misc_answer->transportation, 'motorcycle'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="motorcycle">
                            Sepeda Motor
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input transportation" name="transportation[]" type="checkbox" value="bicycle" id="bicycle">
                        <label class="form-check-label" for="bicycle"
                        @if (str_contains($misc_answer->transportation, 'bicycle'))
                            checked
                        @endif
                        >
                            Sepeda
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input transportation" name="transportation[]" type="checkbox" value="other" id="transportation_other"
                        @if (str_contains($misc_answer->transportation, 'other'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="transportation_other">
                            Transportasi Umum, 
                            <input class="form-input" id="transportation_other_name" name="transportation_other_name"
                            @if (str_contains($misc_answer->transportation, 'other'))
                                value="{{$misc_answer->transportation_other_name}}"
                            @endif
                            >
                        </label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="driver_license" class="form-label col-2 text-start align-self-center mb-0">21. Apakah Anda memiliki Surat Ijin Mengemudi? Pilih salah satu dari opsi di bawah ini. Boleh lebih dari satu.</label>
                    <div class="form-check col">
                        <input class="form-check-input driver_license" name="driver_license[]" class="driver_license" type="checkbox" value="A" id="A"
                        @if (str_contains($misc_answer->driver_license, 'A'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="A">
                            A
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input driver_license" name="driver_license[]" class="driver_license" type="checkbox" value="C" id="C"
                        @if (str_contains($misc_answer->driver_license, 'C'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="C">
                            C
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input driver_license" name="driver_license[]" class="driver_license" type="checkbox" value="B1" id="B1"
                        @if (str_contains($misc_answer->driver_license, 'B1'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="B1">
                            B1
                        </label>
                    </div>
                    <div class="form-check col">
                        <input class="form-check-input driver_license" name="driver_license[]" class="driver_license" type="checkbox" value="B2" id="B2"
                        @if (str_contains($misc_answer->driver_license, 'B2'))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="B2">
                            B2
                        </label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="credit" class="form-label col-2 text-start align-self-center mb-0">22. Apakah Anda memiliki tanggungan atau cicilan? Jika YA sebutkan apa saja dan berapa besarnya? </label>
                    <input type="text" class="form-control col" name="credit" id="credit" placeholder="" value="{{ $misc_answer->credit }}">
                </div>
                <div class="mb-3 row">
                    <label for="financial_support" class="form-label col-2 text-start align-self-center mb-0">23. Apakah Anda masih mendapatkan bantuan keuangan ? Jika YA sebutkan dari mana dan berapa besarnya? </label>
                    <input type="text" class="form-control col" name="financial_support" id="financial_support" placeholder="" value="{{ $misc_answer->financial_support }}">
                </div>
                <div class="mb-3 row">
                    <label for="chronic_illness" class="form-label col-2 text-start align-self-center mb-0">24. Apakah Anda pernah menderita sakit kronis ? Apa dan kapan?</label>
                    <input type="text" class="form-control col" name="chronic_illness" id="chronic_illness" placeholder="" value="{{ $misc_answer->chronic_illness }}">
                </div>
                <div class="mb-3 row">
                    <label for="recurring_health_issues" class="form-label col-2 text-start align-self-center mb-0">25. Apakah Ada gangguan jasmani yang secara tetap mengganggu Anda?</label>
                    <input type="text" class="form-control col" name="recurring_health_issues" id="recurring_health_issues" placeholder="" value="{{ $misc_answer->recurring_health_issues }}">
                </div>
                <div class="mb-3 row">
                    <label for="work_date" class="form-label col-2 text-start align-self-center mb-0">26. Kapan Anda bisa mulai bekerja? </label>
                    <input type="text" class="form-control col" name="work_date" id="work_date" placeholder="" value="{{ $misc_answer->work_date }}">
                </div>
                <div class="mb-3 row">
                    <label for="benefit_expectation" class="form-label col-2 text-start align-self-center mb-0">27. Berapa Gaji dan Fasilitas yang Anda harapkan? </label>
                    <input type="text" class="form-control col" name="benefit_expectation" id="benefit_expectation" placeholder="" value="{{ $misc_answer->benefit_expectation }}">
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-misc">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @include('include/footer')
    <script>
        if (!$('#profile_path').val()) {
            $('#preview_image').hide();
        }

        function preview() {
            $('#preview_image').show();
            frame.src = URL.createObjectURL(event.target.files[0]);
            console.log($('#profile_path').val())
        }
        
        function previewNext() {
            let url = URL.createObjectURL(event.target.files[0]);
            event.target.previousElementSibling.src = url;
            // console.log(event.target.previousElementSibling.src);
        }

        function clearImage() {
            $('#preview_image').hide();
            document.getElementById('profile_path').value = null;
            frame.src = "";
        }

        function monthyearpicker() {
            var DateTime = luxon.DateTime;
            $(".monthyearpicker").each(function (index, value) {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    for (let year = DateTime.local().year; year >= 1970; year--) {
                        for (let month = 12; month > 0; month--) {
                            let show = true;
                            if (year == DateTime.local().year) {
                                if (month > DateTime.local().month) {
                                    show = false;
                                }
                            }
                            if (show) {
                                let date_object = DateTime.local(year, month);
                                let date_to_show = date_object
                                    .setLocale("id")
                                    .toLocaleString({
                                        month: "long",
                                        year: "numeric",
                                    });
                                if ($(this).attr("value") == date_to_show) {
                                    $(this).append(
                                        `<option value="${date_to_show}" selected>${date_to_show}</option>`
                                    );
                                } else {
                                    $(this).append(
                                        `<option value="${date_to_show}">${date_to_show}</option>`
                                    );
                                }
                            }
                        }
                    }
                    $(this).select2({
                        allowClear: true,
                        placeholder: "Pilih Tahun",
                        containerCssClass: 'form-control',
                    });
                    $(this).next().css('width', '100%');
                }
            });
        }

        function yearpicker() {
            var DateTime = luxon.DateTime;
            $(".yearpicker").each(function (index, value) {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    for (let year = DateTime.local().year; year >= 1970; year--) {
                        if ($(this).attr("value") == year) {
                            $(this).append(
                                `<option value="${year}" selected>${year}</option>`
                            );
                        } else {
                            $(this).append(
                                `<option value="${year}">${year}</option>`
                            );
                        }
                    }
                    $(this).select2({
                        allowClear: true,
                        placeholder: "Pilih Tahun",
                        containerCssClass: 'form-control',
                    });
                    $(this).next().css('width', '100%');
                }
            });
        }

        function genderinit() {
            $(".gender").each(function (index, value) {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2({
                        allowClear: true,
                        placeholder: "Pilih Jenis Kelamin",
                        containerCssClass: 'form-control',
                    }); 
                    $('#up-family .gender').next().css('width', '100%');
                    $('#main-family .gender').next().css('width', '100%');
                }
            });
        }

        function getMonthNumber(month_text) { 
            if (month_text == 'Januari') {
                return 1;
            } else if (month_text == 'Februari') {
                return 2;
            } else if (month_text == 'Maret') {
                return 3;
            } else if (month_text == 'April') {
                return 4;
            } else if (month_text == 'Mei') {
                return 5;
            } else if (month_text == 'Juni') {
                return 6;
            } else if (month_text == 'Juli') {
                return 7;
            } else if (month_text == 'Agustus') {
                return 8;
            } else if (month_text == 'September') {
                return 9;
            } else if (month_text == 'Oktober') {
                return 10;
            } else if (month_text == 'November') {
                return 11;
            } else if (month_text == 'Desember') {
                return 12;
            }
        }
    </script>
    {{-- main profile script --}}
    <script>
        $(document).ready(function () {
            if ($('#prof-photo').attr('src')) {
                $('#prof-photo').removeClass('d-block');
            }

            // initialize select2
            $('#religion').select2({
                allowClear: true,
                placeholder: "Pilih Agama"
            })
            $('#marital_status').select2({
                allowClear: true,
                minimumResultsForSearch: Infinity,
                placeholder: "Pilih Status Pernikahan"
            })
            
            genderinit()

            $('#blood_type').select2({
                allowClear: true,
                minimumResultsForSearch: Infinity,
                placeholder: "Pilih Golongan Darah"
            })

            $('#user_short_desc').val($.trim($('#user_short_desc').val()));
            $('#real_address').val($.trim($('#real_address').val()));
            $('#address').val($.trim($('#address').val()));

            if($('#marital_status').val() == "Lajang"){
                $('.depend-marital_status').hide()
            }

            $('#marital_status').change(function (e) { 
                if($(this).val() == "Lajang"){
                    $('.depend-marital_status').hide()
                } else {
                    $('.depend-marital_status').show()
                }
            });

            $('#save-btn').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('biodata-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                $.ajax({
                    type: "post",
                    url: "/user/profile/store",
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: "multipart/form-data",
                    data: submitdata,
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) { 
                        Swal.fire({
                            icon: 'error',
                            text: jqXHR.responseJSON.message
                        }).then((result) => {
                            $.each(jqXHR.responseJSON.errors, function (indexInArray, valueOfElement) { 
                                $(`#${indexInArray}`).addClass('is-invalid');
                                $(`#${indexInArray}`).addClass('mb-0');
                            });
                        })
                    }
                });
            });

            $('.card-body').hide();
            $('#biodata-card').show();
        });

        function showCard(params) {
            // e.preventDefault();
            $('.card-body').hide();
            $('.nav-link').removeClass('active');
            $('#'+params).addClass('active');
            $('#'+params+'-card').show();
        }
    </script>

    {{-- education profile script --}}
    <script>
        $(document).ready(function () {
            monthyearpicker();

            $('#education-add-row').click(function (e) {
                $('#education-table-container').append(`
                    <div class="row">
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama Instansi">
                        </div>
                        <div class="col-md-4 col-data">
                            <input class="form-control" type="text" name="location[]" placeholder="Lokasi">
                        </div>
                        <div class="col-md-1 col-data">
                            <select class="form-control monthyearpicker" name="enroll[]">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-1 col-data">
                            <select class="form-control monthyearpicker" name="graduate[]">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="major[]" placeholder="Jurusan">
                        </div>
                        <div class="col-md-1 col-data">
                            <input class="form-control" type="text" name="degree[]" placeholder="Gelar">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `);

                monthyearpicker();
            });

            $('#save-edu').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('education-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                let pass = checkEdu();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storeedu",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }else{}
            });
        });
        
        function checkEdu() {
            let pass = true;
            $('#education-form input').each(function (index, value) {
                if(!$(this).val()){
                    $(this).addClass('is-invalid');
                    $(this).addClass('mb-0');
                    pass = false;
                }
            })
            if(!pass){
                Swal.fire({
                    icon: 'error',
                    text: "Mohon mengisi data dengan lengkap"
                })
                return pass;
            }
            $('.monthyearpicker').each(function (index, value) {
                if ($(this).attr('name') == 'enroll[]') {
                    let date_text = $(this).select2('data')[0].text.split(" ");
                    let month = getMonthNumber(date_text[0]);
                    let date_object = luxon.DateTime.fromObject({month: month, year: date_text[1]});

                    let grad_text = $(this).parent().next().find(".monthyearpicker").select2('data')[0].text.split(" ");
                    let grad_month = getMonthNumber(grad_text[0]);
                    let grad_object = luxon.DateTime.fromObject({month: grad_month, year: grad_text[1]});
                    
                    if(date_object > grad_object) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Bulan Masuk Melebihi Bulan Keluar'
                        })
                        pass = false;
                    }
                    
                }
            })
            return pass;
        }
    </script>

    {{-- work experience profile script --}}
    <script>
        $(document).ready(function () {
            $('#workexp-add-row').click(function (e) {
                $('#workexp-table-container').append(`
                    <div class="row">
                        <div class="col-1half col-data">
                            <select class="form-control monthyearpicker" name="start[]">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-1half col-data">
                            <select class="form-control monthyearpicker" name="end[]">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama Perusahaan">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="position[]" placeholder="Jabatan">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="net_benefits[]" placeholder="Gaji dan Fasilitas">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="leave_reason[]" placeholder="Alasan Berhenti">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                        <div class="col-md-12 col-data">
                            <textarea class="form-control" name="duties[]" placeholder="Tugas"></textarea>
                        </div>
                    </div>
                `);
                monthyearpicker();
            });

            $('#save-workexp').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('workexp-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                let pass = checkWorkExp();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storeworkexp",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }
            });

            function checkWorkExp() {
                let pass = true;
                $('#workexp-form input').each(function (index, value) {
                    if(!$(this).val()){
                        $(this).addClass('is-invalid');
                        $(this).addClass('mb-0');
                        pass = false;
                    }
                })
                if(!pass) {
                    Swal.fire({
                        icon: 'error',
                        text: "Mohon mengisi data dengan lengkap"
                    })
                }

                $('.monthyearpicker').each(function (index, value) {
                    if ($(this).attr('name') == 'start[]') {
                        let date_text = $(this).select2('data')[0].text.split(" ");
                        let month = getMonthNumber(date_text[0]);
                        let date_object = luxon.DateTime.fromObject({month: month, year: date_text[1]});

                        let grad_text = $(this).parent().next().find(".monthyearpicker").select2('data')[0].text.split(" ");
                        let grad_month = getMonthNumber(grad_text[0]);
                        let grad_object = luxon.DateTime.fromObject({month: grad_month, year: grad_text[1]});
                        
                        if(date_object > grad_object) {
                            Swal.fire({
                                icon: 'error',
                                text: 'Bulan Masuk Melebihi Bulan Keluar'
                            })
                            pass = false;
                        }
                        
                    }
                })
                return pass;
            }
        });
    </script>

    {{-- organisation history profile script --}}
    <script>
        $(document).ready(function () {
            $('#orghist-add-row').click(function (e) {
                $('#orghist-table-container').append(`
                    <div class="row">
                        <div class="col-md-3 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama Organisasi">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="position[]" placeholder="Posisi">
                        </div>
                        <div class="col-md-3 col-data">
                            <input class="form-control" type="text" name="duties[]" placeholder="Tugas">
                        </div>
                        <div class="col-md-3 col-data">
                            <input class="form-control" type="text" name="location[]" placeholder="Lokasi">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `);
            });

            $('#save-orghist').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('orghist-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                let pass = checkOrgHist();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storeorghist",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }
            });

            function checkOrgHist() {
                let pass = true;
                $('#orghist-form input').each(function (index, value) {
                    if(!$(this).val()){
                        $(this).addClass('is-invalid');
                        $(this).addClass('mb-0');
                        pass = false;
                    }
                })
                if(!pass) {
                    Swal.fire({
                        icon: 'error',
                        text: "Mohon mengisi data dengan lengkap"
                    })
                }
                return pass;
            }
        });
    </script>

    {{-- skill list profile script --}}
    <script>
        $(document).ready(function () {
            $('#skill-add-row').click(function (e) {
                $('#skill-table-container').append(`
                    <div class="row">
                        <div class="col-md-3 align-self-center col-data">
                            <input class="form-control" type="text" name="skill[]" placeholder="Ketrampilan">
                        </div>
                        <div class="col-md-3 align-self-center col-data">
                            <input class="form-control" type="text" name="specification[]" placeholder="Lembaga">
                        </div>
                        <div class="col-md-2 align-self-center col-data">
                            <input class="form-range" type="range" name="level[]" placeholder="Level" min="1" max="3">
                        </div>
                        <div class="col-md-3 align-self-center col-data">
                            <img src="" alt="Certificate Photo" class="img-fluid mb-3 d-block">
                            <input class="form-control col-12 d-inline" name="certificate[]" type="file" onchange="previewNext()">
                        </div>
                        <div class="col-md-1 align-self-center col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `);
            });

            $('#save-skill').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('skill-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                let pass = checkSkill();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storeskill",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }
            });

            function checkSkill() {
                let pass = true;
                $('#skill-form input').each(function (index, value) {
                    if(!$(this).parent().parent().find("input[name='id']")){
                        if(!$(this).val()){
                            $(this).addClass('is-invalid');
                            $(this).addClass('mb-0');
                            pass = false;
                        }
                    }
                })
                if(!pass) {
                    Swal.fire({
                        icon: 'error',
                        text: "Mohon mengisi data dengan lengkap"
                    })
                }
                return pass;
            }
        });
    </script>

    {{-- achievement list profile script --}}
    <script>
        $(document).ready(function () {
            yearpicker();

            $('#achievement-add-row').click(function (e) {
                $('#achievement-table-container').append(`
                    <div class="row">
                        <div class="col-md-3 col-data">
                            <input class="form-control" type="text" name="achievement[]" placeholder="Prestasi yang dicapai">
                        </div>
                        <div class="col-md-3 col-data">
                            <input class="form-control" type="text" name="institution[]" placeholder="Lembaga">
                        </div>
                        <div class="col-md-1 col-data">
                            <select class="form-control yearpicker" name="year[]">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-4 col-data">
                            <input class="form-control" type="text" name="description[]" placeholder="Keterangan">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `);

                yearpicker();
            });

            $('#save-achievement').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('achievement-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                let pass = checkAchievement();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storeachievement",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }
            });

            function checkAchievement() {
                let pass = true;
                $('#achievement-form input').each(function (index, value) {
                    if(!$(this).val()){
                        $(this).addClass('is-invalid');
                        $(this).addClass('mb-0');
                        pass = false;
                    }
                })
                if(!pass) {
                    Swal.fire({
                        icon: 'error',
                        text: "Mohon mengisi data dengan lengkap"
                    })
                }
                return pass;
            }
        });
    </script>

    {{-- family profile script --}}
    <script>
        $(document).ready(function () {
            $('#family-add-sibling-row').click(function (e) { 
                e.preventDefault();
                $("#up-family").append(`
                    <div class="row">
                        <div class="col-md-1 col-data">
                            <input class="form-control" type="text" name="relation[]" value="Saudara" readonly>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="name[]" placeholder="Nama">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="pdob[]" placeholder="Tempat, Tanggal Lahir">
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="number" name="age[]" placeholder="Usia">
                        </div>
                        <div class="col-md-2 col-data">
                            <select name="gender[]" class="form-control gender col-4" placeholder="Pilih Jenis Kelamin">
                                <option value=""></option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-data">
                            <input class="form-control" type="text" name="job[]" placeholder="Pekerjaan">
                        </div>
                        <div class="col-md-1 col-data text-white">
                            <button class="btn btn-danger row-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `);
                genderinit();
            });

            $('#save-family').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('family-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                $('#family-form select').each(function (index, value) {
                    if($(this).select2('data')[0].text){
                        $(this).next().removeClass('is-invalid');
                        $(this).next().removeClass('mb-0');
                    }
                })
                let pass = checkFamily();
                if(pass){
                    $.ajax({
                        type: "post",
                        url: "/user/profile/storefamily",
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        data: submitdata,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        }
                    });
                }
            });

            function checkFamily() {
                let pass = true;
                $('#family-form input').each(function (index, value) {
                    if(!$(this).val()){
                        $(this).addClass('is-invalid');
                        $(this).addClass('mb-0');
                        pass = false;
                    }
                })
                $('#family-form select').each(function (index, value) {
                    if(!$(this).select2('data')[0].text){
                        $(this).next().addClass('is-invalid');
                        $(this).next().addClass('mb-0');
                        pass = false;
                    }
                })
                if(!pass) {
                    Swal.fire({
                        icon: 'error',
                        text: "Mohon mengisi data dengan lengkap"
                    })
                }
                return pass;
            }
        });
    </script>

    {{-- misc profile script --}}
    <script>
        $(document).ready(function () {
            $('#save-misc').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('misc-form'));
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                $.ajax({
                    type: "post",
                    url: "/user/profile/storemisc",
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: "multipart/form-data",
                    data: submitdata,
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) { 
                        Swal.fire({
                            icon: 'error',
                            text: jqXHR.responseJSON.message
                        }).then((result) => {
                            array  = ['residence', 'transportation', 'driver_license'];
                            $.each(jqXHR.responseJSON.errors, function (indexInArray, valueOfElement) {
                                if (array.includes(indexInArray)) {
                                    $(`.${indexInArray}`).addClass('is-invalid');
                                    $(`.${indexInArray}`).addClass('mb-0');    
                                }else {
                                    $(`#${indexInArray}`).addClass('is-invalid');
                                    $(`#${indexInArray}`).addClass('mb-0');
                                }
                            });
                        })
                    }
                });
            });
        })
    </script>
</body>
</html>