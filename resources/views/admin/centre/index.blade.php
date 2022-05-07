@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Centre",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Registration Centre'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Centre') }}</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('centre.create') }}"
                                class="btn btn-sm btn-info">{{ __('Add Centre') }}</a>
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
                                <th>{{__('Country')}}</th>
                                <th>{{__('Code')}}</th>

                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($centres as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $cat->center_name}} </td>
                                <td>{{ $cat->country->country_name}} </td>
                                <td>{{ $cat->center_code}} </td>



                                <td class="d-flex">

                                    <!--<a class="btn btn-sm btn-outline-info btn-icon m-1"
                                        href="{{ route('centre.edit', $cat->id) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>-->
                                    <button href="{{route('centre.destroy', $cat->id)}}"
                                        type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deletecentre pull-right">
                                        <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
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
    $(document).on('click', '.deletecentre', function(e){
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
                        success: function(result){ //alert(result.msg);
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Center has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = "{{ route('centre.index') }}";
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
