@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Information",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Information'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Info to the Community') }}</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('information.create') }}"
                                class="btn btn-sm btn-info">{{ __('Create Information') }}</a>
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
                                <th>{{__('Subject')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Venue')}}</th>
                                <th>{{__('Date & Time')}}</th>
                                <th>{{__('Created By')}}</th>
                                <th>{{__('Delete')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($infos) > 0)
                                @foreach($infos as $info)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>


                                    <td>
                                        {{$info->subject}}
                                    </td>
                                    <td>
                                        {{$info->description}}
                                    </td>
                                    <td>
                                        {{$info->venue}}

                                    </td>
                                    <td>
                                       {{$info->date}}

                                    </td>
                                    <td>
                                        {{$info->user->name}}

                                     </td>
                                    <td>
                                        <button href="{{route('information.destroy', $info->id)}}"
                                            type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deleteinformation pull-right">
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





        $(document).on('click', '.deleteinformation', function(e){
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
                                    title: 'Information has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = '{{ route("information.index") }}';
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
