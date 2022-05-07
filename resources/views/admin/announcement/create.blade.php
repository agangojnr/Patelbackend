@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"App Running Message ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'New Announcement',
'text'=>'Create Announcement',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Announceemnt ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('announcement.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('announcement.store') }}" method="POST"
                    enctype="multipart/form-data" id="announcementform">
                        @csrf
                        <div class="form-row">

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Announcement Message:')}}</label>

                                    <textarea name="announcementtext" cols="30" rows="5"
                                        class="form-control   @error('announcementtext') invalid-input @enderror"
                                        required></textarea>
                                    @error('announcementtext')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Set Announcement as Active:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('trending')
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
<link rel="stylesheet" type="text/css" href="{{asset('assets/extra-libs/toastr/dist/build/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')}}">

@endsection

@push('js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>

<script>

        $(document).on('submit', 'form#announcementform', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to CREATE announcement!",
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
                                window.location = "/announcement";
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
