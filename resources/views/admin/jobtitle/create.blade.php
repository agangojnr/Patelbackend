@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Job Description",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'New Job Title',
'text'=>'Create Job Title',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Job Description') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('jobtitle.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('jobtitle.store') }}" method="POST" enctype="multipart/form-data" id="titleform">
                        @csrf
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Job Title:')}}</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control  @error('title') invalid-input @enderror"
                                        placeholder="{{__('Enter  Title')}}" autofocus required>

                                    @error('title')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-control-label" for="validationDefault01">{{__('Business Sector:')}}</label>
                                <select class="form-control" name="sectorid">
                                    <option value="">Choose business sector</option>
                                    @foreach ($sectors as $sec)
                                        <option value="{{$sec['id']}}">{{$sec['sector_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Short Description:')}}</label>

                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control   @error('short_description') invalid-input @enderror"
                                        required></textarea>
                                    @error('short_description')
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
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">

@endsection

@push('js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/dist/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/toastr/toastr-init.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>

<script type="text/javascript">
    $(".select2").select2();
</script>

<script>

        $(document).on('submit', 'form#titleform', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to ADD a Jod Description!",
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
                                    title: 'Job title added successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = "{{ route('jobtitle.index') }}";
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

