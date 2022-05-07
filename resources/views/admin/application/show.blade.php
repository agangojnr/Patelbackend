@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>" Applicant's Details",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>"$details->firstname $details->midname $details->surname"
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('application.index')}}"
            class="btn btn-sm btn-secondary m-1"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
        </div>
        <div class="col">
            <div class="card shadow mb-3">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-2 text-center">
                            <label for="" class="text-default">NAME</label>
                            <h4>{{$details->firstname}}</h4>
                        </div>

                        <div class="col-3 text-center">
                            <label for="" class="text-default">FATHER'S/HUSBAND'S NAME</label>
                            <h4>{{$details->midname}}</h4>
                        </div>

                        <div class="col-2 text-center">
                            <label for="" class="text-default">SURNAME</label>
                            <h4>{{$details->surname}}</h4>
                        </div>

                        <div class="col-3 text-center">
                            <label for="" class="text-default">NATIVE VILAGE IN INDIA</label>
                            <h4>{{$details->Native->native_name}}</h4>
                        </div>
                        <div class="col-2 text-center">
                            <img class="" src="http://127.0.0.1:8000/assets/images/users/5.jpg"
                        width="100" height="100" alt="">
                        </div>

                    </div>
                </div>
                <card-content class="ml-4">
                    <h3>APPLICANT'S DETAILS</h3>
                    <table class="table-bordered">
                        <tr>
                            <td class="p-3">
                                <span for="" class="text-default">Date of Birth</span>
                                <h5>{{$details->birthday}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Nationality</span>
                                <h5>{{$details->Nationality->country_name}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Blood Group</span>
                                <h5>{{$details->bloodgroup}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">P.O. Box</span>
                                <h5>{{$details->boxno}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Town</span>
                                <h5>{{$details->Town->town_name}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Country</span>
                                <h5>{{$details->Country->country_name}}</h5>
                            </td>

                        </tr>
                        <tr>
                            <td class="p-3">
                                <span for="" class="text-default">Phone Number</span>
                                <h5>{{$details->mobile}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Occupation</span>
                                <h5>{{$details->business}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Email Address</span>
                                <h5>{{$details->email}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Physical Address</span>
                                <h5>{{$details->boxno}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Place of Work Address</span>
                                <h5>{{$details->physical_address}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Gender</span>
                                <h5>{{$details->gender}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Marital Status</span>
                                <h5>{{$details->marital}}</h5>
                            </td>
                        </tr>
                    </table>
                    <hr>

                    <h3>SPOUSE DETAILS</h3>
                    <table class="table-bordered">
                        <tr>
                            <td class="p-3">
                                <span for="" class="text-default">Spouse Name</span>
                                <h5>{{\Carbon\carbon::createFromFormat('Y-m-d', $details->birthday)->format('jS F Y')}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Native Vilage in India</span>
                                <h5>{{$details->Nationality->country_name}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Date of Birth</span>
                                <h5>{{$details->bloodgroup}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Nationality</span>
                                <h5>{{$details->boxno}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Blood Group</span>
                                <h5>{{$details->Town->town_name}}</h5>
                            </td>
                        </tr>

                    </table>
                    <hr>

                    <h3>REGISTRATION COMPLIANCE</h3>
                    <table class="table-bordered">
                        <tr>
                            <td class="p-3">
                                <span for="" class="text-default">Membership Type</span>
                                <h5>{{$details->member_type}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Amount Paid</span>
                                <h5>Ksh {{(!empty($payments)) ? $payments->amount_paid : '--'}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Payment Method</span>
                                <h5>{{(!empty($payments)) ? $payments->payment_method: '--'}}</h5>
                            </td>
                            <td class="p-3">
                                <span for="" class="text-default">Payment Reference</span>
                                <h5>{{(!empty($payments)) ? $payments->payment_ref: '--'}}</h5>
                            </td>

                        </tr>
                    </table>
                    <hr>
                    <h4>Confirmation</h4>
                    <table class="table-bordered mb-3">
                        <tr>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Proposed by(Name):</span>
                                <h5>{{(!empty($proposer)) ? $proposer->firstname : '--'}} {{(!empty($proposer)) ? $proposer->midname : '--'}} {{(!empty($proposer)) ? $proposer->surname : '--'}}</h5>
                            </td>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Member Number</span>
                                <h5>{{(!empty($proposer)) ? $proposer->unique_id : '--'}}</h5>
                            </td>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Postal Address</span>
                                <h5>{{(!empty($proposer)) ? $proposer->boxno : '--'}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Seconded by(Name):</span>
                                <h5>{{(!empty($seconder)) ? $seconder->firstname : '--'}} {{(!empty($seconder)) ? $seconder->midname : '--'}} {{(!empty($seconder)) ? $seconder->surname : '--'}}</h5>
                            </td>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Member Number</span>
                                <h5>{{(!empty($seconder)) ? $seconder->unique_id : '--'}}</h5>
                            </td>
                            <td class="p-3" colspan="2">
                                <span for="" class="text-default">Postal Address</span>
                                <h5>{{(!empty($seconder)) ? $seconder->boxno : '--'}}</h5>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row mb-5 mr-2">
                        @if ($details->application_status == 'Pending')

                        <div class="col-2">
                            <button href="{{route('acceptapplication', $details->user_id)}}"
                                type="button" class="btn btn-sm btn-outline-success btn-icon m-1 acceptapplication pull-right">
                                <span class="ul-btn__icon">Accept Application</span>
                            </button>
                        </div>
                        <div class="col-2">
                            <button href="{{route('rejectapplication', $details->user_id)}}"
                                type="button" class="btn btn-sm btn-outline-primary btn-icon m-1 rejectapplication pull-right">
                                <span class="ul-btn__icon">Reject Application</span>
                            </button>
                        </div>
                        @else
                        <div class="col-4">
                            @if ($details->application_status == 'Accepted')
                                <span class="badge badge-success">Application {{$details->application_status}}</span>
                            @elseif($details->application_status == 'Rejected')
                                <span class="badge badge-danger">Application {{$details->application_status}}</span>
                            @endif
                        </div>
                        @endif
                        <div class="col-2"></div>
                        <div class="col-6 text-right">
                            <button href="{{route('application.destroy', $details->user_id)}}"
                                type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deleteapplication pull-right">
                                <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
                            </button>
                        </div>

                    </div>
                </card-content>

            </div>
        </div>
    </div>
</div>

@endsection

@section('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/extra-libs/toastr/dist/build/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')}}">

@endsection

@section('after-scripts')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>

        $(document).on('click', '.deleteapplication', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover these details!",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Delete!",
            cancelButtonText: "No, cancel please!",
                //dangerMode: true,
            }).then((result) => {
                if (Object.values(result) == 'true') {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                            data:{
                            '_token': '{{ csrf_token() }}',
                                },
                        success: function(result){
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/application";
                            } else {
                                //toastr.error(result.msg);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href="">Why do I have this issue?</a>'
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.acceptapplication', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Once accepted the applicant becomes a member.",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Yes, Accept!",
            cancelButtonText: "No, cancel please!",
                //dangerMode: true,
            }).then((result) => {
                if (Object.values(result) == 'true') {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: "GET",
                        url: href,
                        dataType: "json",
                            data:{
                            '_token': '{{ csrf_token() }}',
                                },
                        success: function(result){
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/application";
                            } else {
                                //toastr.error(result.msg);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href="">Why do I have this issue?</a>'
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.rejectapplication', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Reject disqualifies the applicant from being a member.",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Reject!",
            cancelButtonText: "No, cancel please!",
                //dangerMode: true,
            }).then((result) => {
                if (Object.values(result) == 'true') {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: "GET",
                        url: href,
                        dataType: "json",
                            data:{
                            '_token': '{{ csrf_token() }}',
                                },
                        success: function(result){
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/application";
                            } else {
                                //toastr.error(result.msg);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href="">Why do I have this issue?</a>'
                                });
                            }
                        }
                    });
                }
            });
        });
</script>
