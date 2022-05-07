@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Mobile App Announcements",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Announcements'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Announcements') }}</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('announcement.create') }}"
                                class="btn btn-sm btn-info">{{ __('Create Announcement') }}</a>
                        </div>

                    </div>
                </div>

                    <div class="col-12">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>


                <div class="table-responsive">
                    <table id="dataTable" class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Created by')}}</th>
                                <th>{{__('Announcement Text')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                <th>{{__('Delete')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($announcements) > 0)
                                @foreach($announcements as $annou)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{ \Carbon\carbon::createFromFormat('Y-m-d', $annou->date)->format('jS F Y')}}
                                    </td>

                                    <td>
                                        {{$annou->user->name}}
                                    </td>
                                    <td>
                                        {{$annou->announcementtext}}
                                    </td>
                                    <td>
                                        @if ($annou->status == "Active")
                                            <span class="badge badge-success"> {{$annou->status}}</span>
                                        @else
                                            <span class="badge badge-default"> {{$annou->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($annou->status == "Active")
                                        <button href="{{route('deactivate', $annou->id)}}"
                                            type="button" class="btn btn-sm btn-outline-primary btn-icon m-1 deactivateannouncement pull-right">
                                            <span class="ul-btn__icon">Deactivate</span>
                                        </button>
                                        @else
                                        <button href="{{route('activate', $annou->id)}}"
                                            type="button" class="btn btn-sm btn-outline-info btn-icon m-1 activateannouncement pull-right">
                                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> activate</span>
                                        </button>
                                        @endif

                                    </td>
                                    <td>
                                        <button href="{{route('announcement.destroy', $annou->id)}}"
                                            type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deleteannouncement pull-right">
                                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>

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
    $(document).on('click', '.activateannouncement', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Once activated the marquee will run on the app!",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Yes, Activate!",
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
                                    title: 'App Marquee has been activated',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/announcement";
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

         $(document).on('click', '.deactivateannouncement', function(e){
           e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Once deactivated the marquee will not run on the app!",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Deactivate!",
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
                                window.location =  "/announcement";
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


        $(document).on('click', '.deleteannouncement', function(e){
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
                                    title: 'Announcement has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                //window.location = "/announcement";
                                location.href = '{{ route("announcement.index") }}';
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

@endpush
