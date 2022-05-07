@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Business Advert",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>"Advertisement"
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('hotdeals.index') }}"
            class="btn btn-sm btn-secondary m-1"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
        </div>
        <div class="col">
            <div class="card shadow mb-3">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-2 text-center">
                            <label for="" class="text-default">COMPANY NAME</label>
                            <h4>{{$hotdeal->name}}</h4>
                        </div>

                        <div class="col-3 text-center">
                            <label for="" class="text-default">PHYSICAL ADDRESS</label>
                            <h4>{{$hotdeal->address}}</h4>
                        </div>
                        <div class="col-3 text-center">
                            <label for="" class="text-default">COMPANY WEBSITE</label>
                            <h4>{{$hotdeal->website}}</h4>
                        </div>
                        <div class="col-2 text-center">

                        </div>
                        <div class="col-2 text-center">
                            <label for="" class="text-default">Custodian</label>
                            @if ($hotdeal->custodian == 0)
                                <h4>Outsider</h4>
                            @else
                                <h4>{{$hotdeal->appuser->name}}</h4>
                            @endif

                        </div>

                    </div>
                </div>
                <card-content class="ml-4">
                    <h3>BUSINESS INFORMATION</h3>

                    <div class="row">
                        <div class="col-3">
                            <span for="" class="text-default">Client Name</span>
                            <h4>{{$hotdeal->client}}</h4>
                        </div>
                        <div class="col-3">
                            <span for="" class="text-default">Client's Email</span>
                            <h4>{{$hotdeal->email}}</h4>
                        </div>
                        <div class="col-3">
                            <span for="" class="text-default">Client's Contact</span>
                            <h4>{{$hotdeal->primary_contact}}</h4>
                        </div>
                        <div class="col-3">
                            <span for="" class="text-default">Amount Paid</span>
                            <h4>Ksh. {{$hotdeal->amount_paid}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img class="mt-2 img-fluid" src="{{ asset('upload') .'/'.$hotdeal->icon}}"
                            width="300px" height="200px" alt="">
                            <br>
                            <h6 style="font-size: 14px; font-style: italic;">
                                Website: {{$hotdeal->website}}</h6>
                        </div>
                        <div class="col-3">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <span for="" class="text-default">Start Date</span>
                                    <h4>{{\Carbon\carbon::createFromFormat('Y-m-d', $hotdeal->start_date)->format('jS F Y')}}</h4>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <span for="" class="text-default">End Date: <h5>{{\Carbon\carbon::createFromFormat('Y-m-d', $hotdeal->end_date)->format('jS F Y')}}</h5></span>

                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h3 for="" class="text-default">Is Featured?</h3>

                                @if ($hotdeal->is_featured == 'yes')
                                    <h3 class="badge   badge-success m-1">{{__('Yes')}}</h3>
                                    @else
                                    <h3 class="badge   badge-warning  m-1">{{__('No')}}</h3>
                                    @endif

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h3 for="" class="text-default">Status</h3>
                                    @if ($hotdeal->status == 'Active')
                                    <h3 class="badge   badge-success m-1">{{__('Active')}}</h3>
                                    @else
                                    <h3 class="badge   badge-warning  m-1">{{__('Inactive')}}</h3>
                                    @endif


                                </div>
                            </div>
                        </div>

                    </div>


                    <hr>

                    <form action="{{ route('updateadvert') }}" method="POST" id="updateadvert">
                        @csrf
                        <div class="row ml-3 mr-3 pb-4">

                                <div class="col-3">
                                <h3>Update Advert Info</h3>
                                </div>

                                <input type="hidden" name="advertid" value="{{$hotdeal->id}}">


                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group d-flex">
                                                <label class="form-control-label"
                                                    for="validationDefault01">{{__('Featured Lead:')}}</label>
                                                <label class="custom-toggle custom-toggle-primary ml-2">
                                                    <input type="checkbox" @if ($hotdeal->is_featured == 'yes') checked @endif  value="1" name="is_featured">
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                @error('trending')
                                                <div class="invalid-div">{{ $message }}</div>
                                                @enderror


                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group d-flex">
                                                <label class="form-control-label"
                                                    for="validationDefault01">{{__('Status:')}}</label>
                                                <label class="custom-toggle custom-toggle-primary ml-2">
                                                    <input type="checkbox" @if ($hotdeal->status == 'Active') checked @endif value="1" name="status">
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                <h5>Featured Advert Design</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <input type="text" name="adtitle" value="{{ old('amount_paid') }}"
                                                class="form-control  invalid-input"
                                                placeholder="{{__('Enter Ad title (Max 3 words)')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <input type="text" name="promotext" value="{{ old('amount_paid') }}"
                                                class="form-control invalid-input"
                                                placeholder="{{__('Promo/offer/discount e.g. 20% OFF')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="form-group">
                                            <input type="text" name="adinfo" value="{{ old('amount_paid') }}"
                                                class="form-control invalid-input"
                                                placeholder="{{__('Enter Ad info (Max 5 words)')}}" autofocus>
                                        </div>
                                    </div>

                                </div>
                            </div>

                                <div class="col-3">
                                    <button type="submit"
                                    class="btn btn-sm btn-success acceptbtn">{{ __('Save Changes') }}</button>
                                </div>
                                <div class="col-3">

                                </div>


                            <div class="col-4"></div>

                            <div class="col-2">
                                <button href="{{route('hotdeals.destroy', $hotdeal->id)}}"
                                    type="button" class="btn btn-sm btn-outline-danger btn-icon m-1 deladvert">
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
    $(document).on('click', '.deladvert', function(e){
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
                                    title: 'hotdeal has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.href = '{{ route('hotdeals.index') }}';
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

        $(document).on('submit', 'form#updateadvert', function(e){
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to UPDATE to advert!",
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
                                    title: 'Advert updated successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                location.href = '{{ route('hotdeals.show', $hotdeal->id) }}';
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
