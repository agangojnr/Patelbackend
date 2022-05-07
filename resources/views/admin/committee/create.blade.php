@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Patel's Committee",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'New Committee',
'text'=>'Create Patel Committee',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Committee ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('committee.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('committee.store') }}" method="POST"
                    enctype="multipart/form-data" id="committeeform">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Choose Year:')}}</label>
                                    <input type="text" name="year" class="form-control form-control-1 input-sm datepicker bg-white" readonly
                                        id="datepicker" value="{{\Carbon\Carbon::today()->format('Y')}}" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Chairperson:')}}</label>
                                    <input type="text" name="chairperson" value="{{ old('chairperson') }}"
                                        class="form-control  @error('chairperson') invalid-input @enderror"
                                        placeholder="{{__('Name of Chairperson here...')}}" autofocus required>

                                    @error('chairperson')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Vice Chairperson:')}}</label>
                                    <input type="text" name="vicechairperson" value="{{ old('vicechairperson') }}"
                                        class="form-control  @error('vicechairperson') invalid-input @enderror"
                                        placeholder="{{__('Name of Vice Chairperson here...')}}" autofocus required>

                                    @error('vicechairperson')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Secretary:')}}</label>
                                    <input type="text" name="secretary" value="{{ old('secretary') }}"
                                        class="form-control  @error('secretary') invalid-input @enderror"
                                        placeholder="{{__('Name of Secretary here...')}}" autofocus required>

                                    @error('secretary')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Vice Secretary:')}}</label>
                                    <input type="text" name="asssecretary" value="{{ old('asssecretary') }}"
                                        class="form-control  @error('asssecretary') invalid-input @enderror"
                                        placeholder="{{__('Name of Vice Secretary here...')}}" autofocus required>

                                    @error('asssecretary')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Treasurer:')}}</label>
                                    <input type="text" name="treasurer" value="{{ old('treasurer') }}"
                                        class="form-control  @error('treasurer') invalid-input @enderror"
                                        placeholder="{{__('Name of Treasurer here...')}}" autofocus required>

                                    @error('treasurer')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Vice Treasurer:')}}</label>
                                    <input type="text" name="asstreasurer" value="{{ old('asstreasurer') }}"
                                        class="form-control  @error('asstreasurer') invalid-input @enderror"
                                        placeholder="{{__('Name of Vice Treasurer here...')}}" autofocus required>

                                    @error('asstreasurer')
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
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>
$("#datepicker").datepicker( {
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years"
});


        $(document).on('submit', 'form#committeeform', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to CREATE committee!",
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
                                window.location = "/committee";
                            } else {
                                //toastr.error(result.msg);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: result.msg,//'Something went wrong!',
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
