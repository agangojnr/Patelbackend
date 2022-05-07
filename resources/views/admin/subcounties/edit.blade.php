@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Sub Counties",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Sub Counties',
'text'=>'Edit Sub County'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Edit Sub County') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('subcounties.index') }}"
                                class="btn btn-sm btn-danger">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form  action="{{ route("subcounties.update", [$subCounty->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name',$subCounty->name) }}"
                                        class="form-control  @error('name') invalid-input @enderror" placeholder="{{__('Please Enter Name')}}"
                                        autofocus required>
                        
                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-12 mb-3">
                               <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('County:')}}</label>
                                    <select class="js-example-basic form-control" name="county_id">
                                        @foreach ($counties as $cat)
                        
                                      <option value="{{$cat['id']}}" {{$subCounty->county_id == $cat['id'] ? 'selected' : '' }}>{{$cat['name']}}
                                        </option>
                                        @endforeach
                        
                                    </select>
                                    @error('cat_id')
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