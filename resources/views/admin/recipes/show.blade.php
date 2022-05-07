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
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h1 class="mb-0">{{ $recipes->description }}</h1>
                        </div>

                        <div class="col-4 text-right">
                                <label for="" class="text-default">Created by:</label>
                                <h3>{{$recipes->user->name}}</h3>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-3 ml-4">
                        <label for="" class="text-default">Creation Date:</label>
                        <h3 class="badge badge-danger">{{\Carbon\carbon::createFromFormat('Y-m-d', $recipes->date)->format('jS F Y')}}</h3>
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="col-7 text-right">
                        <a href="{{ route('recipes.index')}}"
                            class="btn btn-sm btn-secondary mr-4"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
                    </div>
                    <div class="col-8 mt-2 ml-4">
                        <h3>Ingredients.</h3>
                        <label for="">
                            {{$recipes->ingredients}}

                        </label>
                    </div>

                </div>
                <hr>

                <div class="row ml-3 mr-3 pb-4">
                        <div class="col-3">
                        <h3>Preparation Procedure</h3>
                        </div>
                        <div class="col-10 mb-2">
                            {{$recipes->instructions}}
                        </div>

                    <div class="col-12">
                        <button href="{{route('recipes.destroy', $recipes->id)}}"
                            type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 delrecipe pull-right">
                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i> Delete</span>
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <img class="m-5" src="http://127.0.0.1:8100/assets/images/{{$recipes->picurl}}"
                        width="90%" height="400" alt="">
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

@section('after-scripts')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>
        $(document).on('click', '.delrecipe', function(e){
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
                        success: function(result){ alert(result);
                            if(result.success == true){
                                //toastr.success(result.msg);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location = "/recipes/";
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
