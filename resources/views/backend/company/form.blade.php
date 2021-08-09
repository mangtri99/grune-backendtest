@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Company ADD</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Company</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Company Add</h3>
                </div>
                <div class="box-body">
                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    <form method="POST" action="{{$is_create ? route('company.store') : route('company.update', ['id' => $company->id])}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Name</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="name" class="form-control" value="{{$is_create ? old('name') : $company->name}}">
                                    @foreach ($errors->get('name') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Email</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="email" name="email" class="form-control" value="{{$is_create ? old('email') : $company->email}}">
                                    @foreach ($errors->get('email') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Postcode</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <div>
                                        <input id="postcode" type="number" name="postcode" class="form-control w-100" value="{{$is_create ? old('postcode') : $company->postcode}}">
                                        <div style="margin-top: 1em;">
                                            <button id="btnCheckPostCode" class="btn btn-primary"> Search </button>
                                            <button id="btnResetPostCode" class="btn btn-primary" style="margin-left: 1.5em"> Reset </button>
                                        </div>
                                    </div>
                                    @foreach ($errors->get('postcode') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Prefecture</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <select class="form-control" id="prefecture" name="prefecture_id">
                                        <option value="">Select Prefecture</option>
                                        @foreach ($prefecture as $prefec)
                                            @if($is_create)
                                                <option value="{{$prefec->display_name}}" {{ old('prefecture_id') == $prefec->display_name ? 'selected' : '' }} >{{$prefec->display_name}}</option>
                                            @else
                                                <option value="{{$prefec->display_name}}" {{$company->prefecture_id == $prefec->id ? 'selected' : ''}}>{{$prefec->display_name}}</option>
                                            @endif
                                            
                                        @endforeach
                                        <input id="input_prefecture" type="hidden" name="prefecture_id">
                                    </select>
                                    
                                    
                                    @foreach ($errors->get('prefecture_id') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">City</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input id="city" type="text" name="city" class="form-control" value="{{ $is_create ? old('city') : $company->city}}">
                                    @foreach ($errors->get('city') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Local</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input id="local" type="text" name="local" class="form-control" value="{{$is_create ? old('local') : $company->local}}">
                                    @foreach ($errors->get('local') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">Street Address</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input id="street_address" type="text" name="street_address" class="form-control" value="{{$is_create ? old('street_address') : $company->street_address}}">
                                    @foreach ($errors->get('street_address') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">Bussiness Hours</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="business_hour" class="form-control" value="{{$is_create ? old('business_hour') : $company->business_hour}}">
                                    @foreach ($errors->get('business_hour') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">Regular Holiday</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="regular_holiday" class="form-control" value="{{$is_create ? old('regular_holiday') : $company->regular_holiday}}">
                                    @foreach ($errors->get('regular_holiday') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <strong class="field-title">Phone</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="number" name="phone" class="form-control" value="{{$is_create ? old('phone') : $company->phone}}">
                                    @foreach ($errors->get('phone') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">FAX</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="fax" class="form-control" value="{{$is_create ? old('fax') : $company->fax}}">
                                    @foreach ($errors->get('fax') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">URL</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="url" class="form-control" value="{{$is_create ? old('url') : $company->url}}">
                                    @foreach ($errors->get('url') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    
                                    <strong class="field-title">License Number</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input type="text" name="license_number" class="form-control" value="{{$is_create ? old('license_number') : $company->license_number}}">
                                    @foreach ($errors->get('license_number') as $error)
                                        <span style="color: red">{{$error}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group px-2 px-md-0">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="label label-danger label-required">Required</span>
                                    <strong class="field-title">Image</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    <input id="inputImg" type="file" name="image_file" class="form-control mb-3" value="{{$is_create ? old('image') : $company->image}}">
                                    @foreach ($errors->get('image_file') as $error)
                                        <span class="d-block" style="color: red">{{$error}}</span>
                                    @endforeach
                                    <div class="d-block">
                                        @if($is_create)
                                            <img id="imgPreview" class="mt-3" src="{{asset('img/no-image/no-image.jpg')}}" width="250" alt="">
                                        @else
                                            <img id="imgPreview" src="{{asset('storage/upload/files/' . $company->image) }}" width="250" class="mt-4" alt="">
                                            
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary p-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('title', 'Company Add | ' . env('APP_NAME',''))

@section('css-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#prefecture').select2();
            inputImg.onchange = evt => {
                const [file] = inputImg.files
                if (file) {
                    imgPreview.src = URL.createObjectURL(file)
                }
            }
            if($("#postcode").val()){
                $("#postcode").prop('readonly', true);
                $("#city").prop('readonly', true);
                $("#local").prop('readonly', true); 
                $("#prefecture").change().prop('disabled', true);
                $("#input_prefecture").prop('readonly', true);
            } 

            $("#btnResetPostCode").on('click', function(e){
                e.preventDefault();
                $("#postcode").val("").prop('readonly', false);;
                $("#city").val("").prop('readonly', false);;
                $("#local").val("").prop('readonly', false);; 
                $("#prefecture").val("").change().prop('disabled', false);
                $("#input_prefecture").val("").prop('readonly', false);
            })
            
            
            $("#btnCheckPostCode").on('click', function(e){
                e.preventDefault();
                const postcode = $("#postcode").val();
                $.ajax({
                    type: 'GET',
                    url: '{{URL::to('/api/admin/postcode/getPostCode')}}' + '/' + postcode,
                    success: function (data) {
                        if(data.id){
                            console.log(data)
                            $("#postcode").prop('readonly', true);
                            $("#city").val(data.city).prop('readonly', true);
                            $("#local").val(data.local).prop('readonly', true); 
                            $("#prefecture").val(data.prefecture).change().prop('disabled', true);
                            $("#input_prefecture").val(data.prefecture).prop('readonly', true);
                        }else{
                            console.log(data)
                            alert("PostCode Not Found")
                        }
                    }
                })

            });
            // function checkPostCode() {
            //                }
        });
    </script>
@endsection
