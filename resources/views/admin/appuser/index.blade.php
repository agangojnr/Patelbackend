@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"App Users",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'App Users List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Mobile App User') }}</h3>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone No')}}</th>
                                <th>{{__('Address')}}</th>

                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appuser as $ss)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $ss->name}}</td>
                                <td><a href="mailto:{{$ss->email}}">{{$ss->email}}</a></td>
                                <td><a href="tel:{{$ss->phone_no}}">{{$ss->phone_no}}</a></td>
                                <td>{{$ss->address}}</td>

                                <td>
                                    @if ($ss->status)
                                    <span class="badge  badge-success m-1">{{__('Active')}}</span>
                                    @else
                                    <span class="badge  badge-warning  m-1">{{__('Block')}}</span>

                                    @endif
                                </td>
                                <td class="d-flex">

                                        <button type="button" href="{{route('activateblock', $ss->id)}}"
                                            class="btn btn-sm btn-outline-{{$ss->status ?'danger' :'primary'}} btn-icon m-1 activateblockappuser">
                                            <span class="ul-btn__icon">
                                                @if ($ss->status)
                                                <i class="fas fa-ban"></i>
                                                @else
                                                <i class="fas fa-shield-alt"></i>
                                                @endif
                                            </span>
                                        </button>

                                </td>
                            </tr>
                            @endforeach
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
    $(document).on('click', '.activateblockappuser', function(e){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You will change the status of the app user!",
                type: "warning",
                //buttons: true,

            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Change!",
            cancelButtonText: "No, cancel please!",
                //dangerMode: true,
            }).then((result) => {
                if (Object.values(result) == 'true') {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: "CHANGE STATUS",
                        url: href,
                        dataType: "json",
                            data:{
                            '_token': '{{ csrf_token() }}',
                                },
                        success: function(result){ console.log('yess');
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'User status has been changed',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                               // window.location = "/native";
                                location.href = '{{ route("appuser.index") }}';
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
