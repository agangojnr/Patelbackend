@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Offers",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Offer',
'text'=>'New Offer',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Offer Detail') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('offers.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Title:')}}</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control  @error('title') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Title')}}" required autofocus>

                                    @error('title')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Branch:')}}</label>
                                    <select class="js-example-basic form-control" name="branch_id[]"
                                        multiple="multiple">
                                        @foreach ($branch as $b)

                                        <option value="{{$b['id']}}">{{$b['name']}}</option>
                                        @endforeach

                                    </select>

                                    @error('branch_id')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Maximum par user:')}} <sup>leave blank to
                                            unlimited</sup></label>
                                    <input type="number" name="max_use_user" value="{{ old('max_use_user') }}"
                                        class="form-control  @error('max_use_user') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Maximum par user')}}">

                                    @error('max_use_user')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Minium Amount:')}}
                                        <sup>Minium Amount need to apply code </sup> </label>
                                    <input type="number" name="min_amount" value="{{ old('min_amount') }}"
                                        class="form-control  @error('min_amount') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Min Amount')}}" required>

                                    @error('min_amount')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('How Expire:')}}</label>
                                    <select class="js-example-basic form-control" name="how_expire"
                                        onchange="expireChange()">

                                        <option value="0">Using Date</option>
                                        <option value="1">Using Maximum usage</option>


                                    </select>

                                    @error('how_expire')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group" id="expiry_date">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Expiry Date:')}}</label>
                                    <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                                        class="form-control  @error('expiry_date') invalid-input @enderror">

                                    @error('expiry_date')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-none" id="max_usage">
                                    <label class="form-control-label" for="validationDefault01">{{__('Max Usage:')}}
                                        <sup>All Time User Use</sup> </label>
                                    <input type="text" name="max_usage" value="{{ old('max_usage') }}"
                                        class="form-control  @error('max_usage') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Max Usage')}}">

                                    @error('max_usage')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Discount Type:')}}</label>

                                    <select class="js-example-basic form-control" name="discount_type">

                                        <option value="0">Amount</option>
                                        <option value="1">Percentage</option>


                                    </select>

                                    @error('discount_type')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Discount:')}}</label>
                                    <input type="text" name="discount" value="{{ old('discount') }}"
                                        class="form-control  @error('discount') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Discount')}}" required>

                                    @error('discount')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-12 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Status:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>


                        </div>


                        <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
