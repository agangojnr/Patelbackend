@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Business & Job ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'New Business & Job',
'text'=>'Create Business & Job',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h class="mb-0">{{ __('New Business & Job ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('businessjob.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('businessjob.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Title:')}}</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control  @error('title') invalid-input @enderror"
                                        placeholder="{{__('Enter  Title')}}" autofocus required>

                                    @error('title')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                               <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="validationDefault01">{{__('Business Or Job:')}}</label>
                                        <select class="js-example-basic form-control" name="businee_or_job">
                                
                                            <option value="0">Job</option>
                                            <option value="1">Business</option>
                                            
                                
                                
                                        </select>
                                        @error('businee_or_job')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="validationDefault01">{{__('Category:')}}</label>
                                        <select class="js-example-basic form-control" name="bus_job_cat_id">
                                
                                            @foreach ($categories as $cat)

                                        <option value="{{$cat['cat_id']}}">{{$cat['cat_name']}}</option>
                                        @endforeach
                                            
                                
                                
                                        </select>
                                        @error('bus_job_cat_id')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            


                           
                           <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Name:')}}</label>


                                    <input type="text" name="business_job_name" value="{{ old('business_job_name') }}"
                                        class="form-control  @error('business_job_name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Sponsor name')}}" autofocus required>

                                    @error('business_job_name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                              
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Email:')}}</label>
                                    <input type="text" name="email_address" value="{{ old('email_address') }}"
                                        class="form-control  @error('email_address') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Email')}}" autofocus required>

                                    @error('email_address')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Primary Contact:')}}</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                        class="form-control  @error('phone_number') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Contact')}}" autofocus required>

                                    @error('phone_number')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                         

                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Sponsor Physical Address:')}}</label>
                                    <input type="text" name="business_job_location" value="{{ old('business_job_location') }}"
                                        class="form-control  @error('business_job_location') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Location')}}" autofocus required>

                                    @error('business_job_location')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Experience :')}}</label>
                                    <input type="text" name="experience" value="{{ old('experience') }}"
                                        class="form-control  @error('experience') invalid-input @enderror"
                                        placeholder="{{__('Enter  Experience')}}" autofocus required>

                                    @error('experience')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                               <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Vacancy :')}}</label>
                                    <input type="text" name="vacancy" value="{{ old('vacancy') }}"
                                        class="form-control  @error('vacancy') invalid-input @enderror"
                                        placeholder="{{__('Enter  Vacancy')}}" autofocus required>

                                    @error('vacancy')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                          
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Short Description:')}}</label>

                                    <textarea name="short_description" cols="30" rows="5"
                                        class="form-control   @error('short_description') invalid-input @enderror"
                                        required></textarea>
                                    @error('short_description')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>


                             <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Long Description:')}}</label>

                                    <textarea name="long_decription" cols="30" rows="5"
                                        class="form-control   @error('long_decription') invalid-input @enderror"
                                        required></textarea>
                                    @error('long_decription')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>

                          
                            
                                
                          <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Status:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status" checked>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                       
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Featured:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="is_featured">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('is_featured')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                           


                        </div>


                        <button class="btn btn-info" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')


@endsection
