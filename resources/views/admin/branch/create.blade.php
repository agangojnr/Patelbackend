@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Leads ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Leads',
'text'=>'New Lead',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h class="mb-0">{{ __('New Lead ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('branch.index') }}"
                                class="btn btn-sm btn-info">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{ route('branch.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Subject:')}}</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Enter  Subject')}}" autofocus required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                          
                               <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Category:')}}</label>
                                    <select class="js-example-basic form-control" name="category">
                                       
                                       @foreach ($categories as $cat)

                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach
                                        

                                    </select>
                                    @error('level ')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Sponsor Type:')}}</label>
                                    <select class="js-example-basic form-control" name="for_who">
                                       
                                        <option value="1">Direct Link To Investors</option>
                                        <option value="2">Co-oprate Applications</option>
                                    
                                        

                                    </select>
                                    @error('regulator ')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        
                           <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Name:')}}</label>
                                    <input type="text" name="sponsor_name" value="{{ old('sponsor_name') }}"
                                        class="form-control  @error('sponsor_name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Sponsor name')}}" autofocus required>

                                    @error('sponsor_name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                              
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Email:')}}</label>
                                    <input type="text" name="email" value="{{ old('email') }}"
                                        class="form-control  @error('email') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Email')}}" autofocus required>

                                    @error('email')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Primary Contact:')}}</label>
                                    <input type="text" name="primary_contact" value="{{ old('primary_contact') }}"
                                        class="form-control  @error('primary_contact') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Contact')}}" autofocus required>

                                    @error('primary_contact')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Sponsor Secondary Contact:')}}</label>
                                    <input type="text" name="secondary_contact" value="{{ old('secondary_contact') }}"
                                        class="form-control  @error('secondary_contact') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Contact')}}" autofocus>

                                    @error('secondary_contact')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                              <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Sponsor Physical Address:')}}</label>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control  @error('address') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Location')}}" autofocus required>

                                    @error('address')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Application Fees:')}}</label>
                                    <input type="text" name="application_fee" value="{{ old('application_fee') }}"
                                        class="form-control  @error('application_fee') invalid-input @enderror"
                                        placeholder="{{__('Enter  Application Fees')}}" autofocus required>

                                    @error('application_fees')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                          
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Description:')}}</label>

                                    <textarea name="description" cols="30" rows="5"
                                        class="form-control   @error('description') invalid-input @enderror"
                                        required></textarea>
                                    @error('description')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                            
                            
                                
                         
                       
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Image:')}}</label>
                                    <input type="file" name="icon"
                                        class="form-control file-input  @error('icon') invalid-input @enderror"
                                        required accept="image/*">
                                    @error('icon')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex">
                                    <label class="form-control-label"
                                        for="validationDefault01">{{__('Featured Lead:')}}</label>
                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                        <input type="checkbox" value="1" name="is_featured">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                    @error('trending')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
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


                        <button class="btn btn-info" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">

   $('#county_id').on('change', function(e){
   

   var county_id = e.target.value;

 $.get('/api/county-dropdown?county_id=' + county_id, function(data){

           //success data
           $('#subcounty_id').empty();

         //  $('#subcounty_id').append(' <option>Please Choose Sub County<option/>');



           $.each(data, function (index, value) {
  $('#subcounty_id').append($('<option/>', { 
      value: value.id,
      text : value.name
  }));
});


         });
   });
</script>
@endsection
