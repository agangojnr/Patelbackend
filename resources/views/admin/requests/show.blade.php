@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Request for Assistance",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Request for Assistance'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12">

            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h1 class="mb-0">{{ $request->category }}</h1>
                        </div>

                        <div class="col-4 text-right">
                                <label for="" class="text-default">Requested by:</label>
                                <h3>{{$request->user->name}}</h3>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-3 ml-4">
                        <label for="" class="text-default">Request Date:</label>
                        <h3>{{\Carbon\carbon::createFromFormat('Y-m-d', $request->date)->format('jS F Y')}}</h3>
                    </div>
                    <div class="col-1">
                        <label for="" class="text-default">Status: </label>
                            @if ($request->status == "Pending")
                                    <h3 class="badge badge-info">{{ $request->status}}</h3>
                                @elseif($request->status == "Accepted")
                                    <h3 class="badge badge-success">{{ $request->status}}</h3>
                                @elseif($request->status == "Rejected")
                                    <h3 class="badge badge-danger">{{ $request->status}}</h3>
                            @endif
                    </div>
                    <div class="col-7 text-right">
                        <a href="{{ route('requests.index')}}"
                            class="btn btn-sm btn-secondary mr-4"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
                    </div>
                    <div class="col-8 mt-2 ml-4">
                        <h3>Request Info.</h3>
                        <label for="">
                            {{$request->description}}

                        </label>
                    </div>

                </div>
                <hr>


            <form action="{{ route('acceptrejectrequest') }}" method="POST" id="accept_reject">
                @csrf
                <div class="row ml-3 mr-3 pb-4">

                    @if ($request->status == "Pending")

                        <div class="col-3">
                        <h3>Response Info</h3>
                        </div>
                        <div class="col-10 mb-2">
                            <input required class="bg-success" type="radio" name="status" value="Accepted"> <label>Accept Request</label>
                            <input required class="bg-danger ml-5" type="radio" name="status" value="Rejected"> <label>Reject Request</label>

                        </div>
                        <div class="col-10">
                            <input type="hidden" name="requestid" id="requestid" value="{{$request->id}}">
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
                                {{$request->response}}
                            </label>
                        </div>
                        <div class="col-6">
                            <h3>{{\Carbon\carbon::createFromFormat('Y-m-d', $request->response_date)->format('jS F Y')}}</h3>
                        </div>
                    @endif
                    <div class="col-4"></div>
                    <div class="col-2">
                        <button href="{{route('requests.destroy', $request->id)}}"
                            type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 delrequest">
                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
                        </button>
                    </div>
                </div>
            </form>

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

        $(document).on('click', '.delrequest', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this request details!",
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
                                window.location = "/requests/";
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

                        success: function(result){
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Response successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/requests/{{$request->id}}";
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
