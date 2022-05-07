@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Branches",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Branch',
'text'=>'Edit Branch'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Edit Branch') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('branch.index') }}"
                                class="btn btn-sm btn-danger">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form enctype="multipart/form-data" action="{{ route("branch.update", [$branch->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Registration Number:')}}</label>
                                    <input type="text" name="registration_number" value="{{ old('registration_number',$branch->registration_number) }}"
                                        class="form-control  @error('registration_number') invalid-input @enderror"
                                        placeholder="{{__('Please Registratin Number')}}" autofocus required>

                                    @error('registration_number')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name',$branch->name) }}"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Name')}}" autofocus required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Rugulator:')}}</label>
                                    <select class="js-example-basic form-control" name="regulator">
                                       
                                        <option value="1" {{$branch->regulator == 1 ? 'selected' : '' }}>Public</option>
                                        <option value="2" {{$branch->regulator == 2 ? 'selected' : '' }}>Private</option>
                                    
                                        

                                    </select>
                                    @error('regulator ')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                               <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Physical Address:')}}</label>
                                    <input type="text" name="address" value="{{ old('address',$branch->address) }}"
                                        class="form-control  @error('address') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Address')}}" autofocus required>

                                    @error('address')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                               <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Level:')}}</label>
                                    <select class="js-example-basic form-control" name="level">
                                       
                                        <option value="1" {{$branch->level == 1 ? 'selected' : '' }}>Level 1</option>
                                        <option value="2" {{$branch->level == 2 ? 'selected' : '' }}>Level 2</option>
                                        <option value="3" {{$branch->level == 3 ? 'selected' : '' }}>Level 3</option>
                                        <option value="4" {{$branch->level == 4 ? 'selected' : '' }}>Level 4</option>
                                        <option value="5" {{$branch->level == 5 ? 'selected' : '' }}>Level 5</option>
                                    
                                        

                                    </select>
                                    @error('level ')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('County:')}}</label>
                                    <select id="county_id" class="js-example-basic form-control" name="county_id">
                                        @foreach ($counties as $cat)

                                        <option value="{{$cat['id']}}" {{$branch->county_id == $cat['id'] ? 'selected' : '' }}>{{$cat['name']}}</option>
                                        @endforeach

                                    </select>
                                    @error('county_id')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Sub County:')}}</label>
                                    <select id="subcounty_id" class="js-example-basic form-control" name="subcounty_id">
                                        @foreach ($subcounties as $cat)

                                        <option value="{{$cat['id']}}" {{$branch->subcounty_id == $cat['id'] ? 'selected' : '' }}>{{$cat['name']}}</option>
                                        @endforeach

                                    </select>
                                    @error('cat_id')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Email:')}}</label>
                                    <input type="text" name="email" value="{{ old('email',$branch->email) }}"
                                        class="form-control  @error('email') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Email')}}" autofocus required>

                                    @error('email')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Primary Contact:')}}</label>
                                    <input type="text" name="primary_contact" value="{{ old('primary_contact',$branch->primary_contact) }}"
                                        class="form-control  @error('primary_contact') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Primary Contact')}}" autofocus required>

                                    @error('primary_contact')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Secondary Contact:')}}</label>
                                    <input type="text" name="secondary_contact" value="{{ old('secondary_contact',$branch->secondary_contact) }}"
                                        class="form-control  @error('secondary_contact') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Secondary Contact')}}" autofocus>

                                    @error('secondary_contact')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                         

                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Open Time:')}}</label>
                                    <input type="time" name="start_time" value="{{ old('start_time',$branch->start_time) }}"
                                        class="form-control  @error('start_time') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Name')}}" autofocus required>

                                    @error('start_time')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Close Time:')}}</label>
                                    <input type="time" name="end_time" value="{{ old('end_time',$branch->end_time) }}"
                                        class="form-control  @error('end_time') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Name')}}" autofocus required>

                                    @error('end_time')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                                   <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Vaccine Type:')}}</label>
                                    <select class="js-example-basic form-control" name="category[]" multiple="multiple">
                                        @foreach ($categories as $cat)

                                        <option value="{{$cat['id']}}" {{in_array($cat->id, old("category",$branch->category) ?: []) ? "selected": ""}}>{{$cat['name']}}</option>
                                        @endforeach

                                    </select>
                                    @error('category')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Description:')}}</label>

                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control file-input  @error('description') invalid-input @enderror"
                                required>{{$branch->description}}</textarea>
                                    @error('description')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                          
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Image:')}}</label>
                                    <input type="file" name="icon"
                                        class="form-control file-input  @error('icon') invalid-input @enderror" 
                                        accept="image/*">
                                    @error('icon')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Featured Branch:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="is_featured" {{$branch->is_featured ? 'checked' : ''}}>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('trending')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Status:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status" {{$branch->status ? 'checked' : ''}}>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>


                        </div>

                        <button class="btn btn-danger" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection