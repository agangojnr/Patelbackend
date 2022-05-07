<form enctype="multipart/form-data" action="{{ route('onesignal.update') }}" method="POST">
    @csrf
    <div class="row mb-3">



        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('APP_ID')}}</label>
            <div class="input-group">
                <input type="password" name="APP_ID" class="form-control  @error('APP_ID') invalid-input @enderror"
                    required min="1" value="{{$master['APP_ID'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('APP_ID')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('APP_ID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('REST_API_KEY')}}</label>

            <div class="input-group">
                <input type="password" name="REST_API_KEY"
                    class="form-control  @error('REST_API_KEY') invalid-input @enderror" required min="1"
                    value="{{$master['REST_API_KEY'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('REST_API_KEY')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('REST_API_KEY')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('USER_AUTH_KEY')}}</label>
            <div class="input-group">
                <input type="password" name="USER_AUTH_KEY"
                    class="form-control  @error('USER_AUTH_KEY') invalid-input @enderror" required min="1"
                    value="{{$master['USER_AUTH_KEY'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('USER_AUTH_KEY')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('TWILIO_SID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('PROJECT_NUMBER')}}</label>
            <div class="input-group">
                <input type="password" name="PROJECT_NUMBER"
                    class="form-control  @error('PROJECT_NUMBER') invalid-input @enderror" required min="1"
                    value="{{$master['PROJECT_NUMBER'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('PROJECT_NUMBER')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('PROJECT_NUMBER')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>