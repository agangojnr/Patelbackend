@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Leads ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'New Deal',
'text'=>'Create Deal',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Lead ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('hotdeals.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('hotdeals.store') }}" method="POST" enctype="multipart/form-data" id="advertform">

                        @csrf
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Company Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Enter company or business name')}}" autofocus required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                           <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Company Website:')}}</label>
                                    <input type="text" name="website" value="{{ old('sponsor_name') }}"
                                        class="form-control  @error('sponsor_name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter website URL')}}" autofocus required>

                                    @error('sponsor_name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Company Email:')}}</label>
                                    <input type="text" name="email" value="{{ old('email') }}"
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
                                    <input type="text" name="primary_contact" value="{{ old('primary_contact') }}"
                                        class="form-control  @error('primary_contact') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Contact')}}" autofocus required>

                                    @error('primary_contact')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Physical Address:')}}</label>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control  @error('address') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Location')}}" autofocus required>

                                    @error('address')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Application Fees:')}}</label>
                                    <input type="text" name="amount_paid" value="{{ old('amount_paid') }}"
                                        class="form-control  @error('amount_paid') invalid-input @enderror"
                                        placeholder="{{__('Enter  Application Fees')}}" autofocus required>

                                    @error('amount_paid')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Start Date:')}}</label>
                                    <input type="text" name="start_date" class="form-control form-control-1 input-sm datepicker bg-white" readonly
                                        value="{{\Carbon\Carbon::today()->format('m/d/Y')}}" autocomplete="off" />
                                </div>
                            </div>



                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Duration (In days):')}}</label>
                                    <input type="number" name="duration" value="{{ old('amount_paid') }}"
                                    class="form-control  @error('amount_paid') invalid-input @enderror"
                                    placeholder="{{__('E.g 10 days')}}" autofocus required>
                                </div>
                            </div>



                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Advert Custodian:')}}</label>
                                    <select class="form-control" name="custodian">
                                        <option value="">Choose Custodian</option>
                                        <option value="0">Outsider</option>
                                        @foreach ($appusers as $user)
                                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Description:')}}</label>

                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control   @error('description') invalid-input @enderror"
                                        required></textarea>
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
                                        required accept="image/*">
                                    @error('icon')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Featured Lead:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="is_featured">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('trending')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 mb-3">
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


                        <button class="btn btn-info" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap/dist/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/extra-libs/toastr/dist/build/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')}}">

@endsection


@push('js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>
$(function(){
    'use strict'
    var today = new Date();
    $('.datepicker').datepicker({
    autoclose: true,
    singleDatePicker: true,
    showDropdowns: true,
    dateFormat: 'dd/mm/yy',
    endDate: "today",
    maxDate: today
    });
});



$(document).on('submit', 'form#advertform', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to ADD a Jod Description!",
                type: "warning",

            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Yes, Save!",
            cancelButtonText: "No, cancel please!",
                //dangerMode: true,
            }).then((result) => {
                if (Object.values(result) == 'true') {
                    $.ajax({
                        method: "post",
                        url: $(this).attr("action"),
                        dataType: "json",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,

                        success: function(result){ console.log(result);
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Advert created successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = "{{ route('hotdeals.index') }}";
                            } else {
                                //toastr.error(result.msg);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href="#">Why do I have this issue?</a>'
                                });
                            }
                        }
                    });
                }
            });
        });
 </script>
@endpush
