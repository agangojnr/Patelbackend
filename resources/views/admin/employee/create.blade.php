@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Employees",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Employee',
'text'=>'New Employee',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Employee Detail') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('employee.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Name')}}" required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Address:')}}</label>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control  @error('address') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Address')}}" required>

                                    @error('address')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Email:')}}</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control  @error('email') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Email')}}" required>

                                    @error('email')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Password:')}}</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control  @error('password') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Password')}}" min="6" required>

                                    @error('password')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Description:')}}</label>

                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control file-input  @error('icon') invalid-input @enderror"
                                        required></textarea>
                                    @error('description')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Experience:')}}</label>
                                    <input type="text" name="experience" value="{{ old('experience') }}"
                                        class="form-control  @error('experience') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Experience')}}" required>

                                    @error('experience')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Service:')}}</label>
                                    <select class="js-example-basic form-control" name="service[]" multiple="multiple">
                                        @foreach ($subCate as $cat)

                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach

                                    </select>
                                    @error('service')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Image:')}}</label>
                                    <input type="file" name="icon"
                                        class="form-control file-input  @error('icon') invalid-input @enderror" required
                                        accept="image/*">
                                    @error('icon')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Status:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>


                        </div>


                        <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
