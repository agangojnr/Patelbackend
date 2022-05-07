@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Vaccines",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Vaccines',
'text'=>'Vaccines'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Edit Vacines') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('subcategories.index') }}"
                                class="btn btn-sm btn-danger">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form enctype="multipart/form-data"  action="{{ route("subcategories.update", [$subCategory->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name',$subCategory->name) }}"
                                        class="form-control  @error('name') invalid-input @enderror" placeholder="{{__('Please Enter Name')}}"
                                        autofocus required>
                        
                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Price:')}}</label>
                                    <input type="number" name="price" value="{{ old('price',$subCategory->price) }}"
                                        class="form-control  @error('price') invalid-input @enderror" placeholder="{{__('Please Enter Price')}}"
                                        autofocus required>
                            
                                    @error('price')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Category:')}}</label>
                                    <select class="js-example-basic form-control" name="cat_id">
                                        @foreach ($categories as $cat)
                        
                                      <option value="{{$cat['id']}}" {{$subCategory->cat_id == $cat['id'] ? 'selected' : '' }}>{{$cat['name']}}
                                        </option>
                                        @endforeach
                        
                                    </select>
                                    @error('cat_id')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Description:')}}</label>
                        
                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control file-input  @error('icon') invalid-input @enderror" >{{$subCategory->description}}</textarea>
                                    @error('description')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                        
                        
                                </div>
                            </div>
                           <!-- <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Service For:')}}</label>
                                    <select class="js-example-basic form-control" name="for_who">
                        
                                        <option value="0" {{$subCategory->for_who == 0 ? 'selected' : '' }}>Man & Women</option>
                                        <option value="1" {{$subCategory->for_who == 1 ? 'selected' : '' }}>Women</option>
                                        <option value="2" {{$subCategory->for_who == 2 ? 'selected' : '' }}>Man</option>
                        
                        
                                    </select>
                                    @error('for_who ')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Duration: ')}} <sup>*in minute</sup>
                                    </label>
                                    <input type="number" name="duration" value="{{ old('duration',$subCategory->duration) }}"
                                        class="form-control  @error('duration') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Duration In Min')}}" autofocus required>
                        
                                    @error('duration')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Preparation Time: ')}} <sup>*in
                                            minute</sup> </label>
                                    <input type="number" name="preparation_time" value="{{ old('preparation_time',$subCategory->preparation_time) }}"
                                        class="form-control  @error('preparation_time') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Preparation Time In Min')}}" autofocus required>
                        
                                    @error('preparation_time')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>-->
                           
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label" for="validationDefault01">{{__('Best Service:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="is_best" {{$subCategory->is_best ? 'checked' : ''}}>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                    @error('is_best')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                        
                        
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label" for="validationDefault01">{{__('Status:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="status" {{$subCategory->status ? 'checked' : ''}}>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                        
                        
                                </div>
                            </div>
                        
                        
                        </div>

                        <button class="btn btn-danger" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection