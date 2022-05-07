@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Job Post",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>"Job Description"
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('jobpost.index') }}"
            class="btn btn-sm btn-secondary m-1"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
        </div>
        <div class="col">
            <div class="card shadow mb-3">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-2 text-center">
                            <label for="" class="text-default">SECTOR</label>
                            <h5>{{$job->Jobtitle->Businesssector->sector_name}}</h5>
                        </div>

                        <div class="col-5 text-center">
                            <label for="" class="text-default">JOB NAME</label>
                            <h4>{{$job->Jobtitle->title}}</h4>
                        </div>

                        <div class="col-3 text-center">

                        </div>
                        <div class="col-2 text-center">
                            <label for="" class="text-default">Created By</label>
                            <h4>{{$job->appuser->name}}</h4>
                        </div>

                    </div>
                </div>
                <card-content class="m-4">
                    <div class="row">
                        <div class="col-12">
                            <h3 for="" class="text-default">Job Requirements</h3>
                            <h5>{{$job->job_requirements}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3 for="" class="text-default">Job Qualifications</h3>
                            <h5>{{$job->job_qualifications}}</h5>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-4">
                            <span for="" class="text-default">Work Experience</span>
                                <h5>{{$job->experience}}</h5>
                        </div>
                        <div class="col-4">
                            <span for="" class="text-default">Vacancy</span>
                                <h5>{{$job->no_of_vacancies}} Position(s)</h5>
                        </div>
                        <div class="col-4">
                            <span for="" class="text-default">Application Deadline</span>
                                <h5>{{\Carbon\carbon::createFromFormat('Y-m-d', $job->appln_deadline)->format('jS F Y')}}</h5>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4">
                            <span for="" class="text-default">Contact</span>
                                <h5>{{$job->contact}}</h5>
                        </div>
                        <div class="col-4">
                            <span for="" class="text-default">Send Application to.:</span>
                                <h5>{{$job->email}}</h5>
                        </div>
                    </div>

                    <hr>

                    <form action="{{ route('acceptrejectjobpost') }}" method="POST" id="accept_reject">
                        @csrf
                        <div class="row ml-3 mr-3 pb-4">

                            @if ($job->status == "Pending")

                                <div class="col-3">
                                <h3>Response Info</h3>
                                </div>
                                <div class="col-10 mb-2">
                                    <input required class="bg-success" type="radio" name="status" value="Accepted"> <label>Accept Job Post</label>
                                    <input required class="bg-danger ml-5" type="radio" name="status" value="Rejected"> <label>Reject Job Post</label>

                                </div>
                                <div class="col-10">
                                    <input type="hidden" name="jobid" id="jobid" value="{{$job->id}}">
                                    <textarea class="form-control mb-3" required name="response" id="response" cols="30" rows="2"
                                    placeholder="Enter response text here..."></textarea>
                                </div>
                                <div class="col-3">
                                    <button type="submit"
                                    class="btn btn-sm btn-success acceptbtn">{{ __('Save Response') }}</button>
                                </div>
                                <div class="col-3">

                                </div>
                            @else
                            <div class="col-3">
                                <h3>Response Info</h3>
                                </div>

                                <div class="col-10">
                                    <label for="">
                                        {{$job->response_info}}
                                    </label>
                                </div>
                                <div class="col-6">
                                    <h3>{{\Carbon\carbon::createFromFormat('Y-m-d', $job->response_date)->format('jS F Y')}}</h3>
                                </div>
                            @endif
                            <div class="col-2"></div>
                            <div class="col-2 pt-2">
                                    @if ($job->status == 'Accepted')
                                        <span class="badge badge-success">Job Post &nbsp; {{$job->status}}</span>
                                    @elseif($job->status == 'Rejected')
                                        <span class="badge badge-danger">Job Post &nbsp; {{$job->status}}</span>
                                    @endif
                            </div>
                            <div class="col-2">
                                <button href="{{route('jobpost.destroy', $job->id)}}"
                                    type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deljob">
                                    <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
                                </button>
                            </div>
                        </div>
                    </form>

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


@push('js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>
    $(document).on('click', '.deljob', function(e){
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
                                    title: 'Job Post has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = '{{ route('jobpost.index') }}';
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

        $(document).on('submit', 'form#accept_reject', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to RESPOND to request!",
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

                        success: function(result){ //alert(result.msg);
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Response successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                location.href = '{{ route('jobpost.show', $job->id) }}';
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
