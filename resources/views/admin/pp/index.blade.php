@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Roles",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Roles'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Roles ') }}</h3>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="col-md-12 mb-4">
                    <form action="{{ route('pp.update') }}" method="POST">
                        @csrf
                        <div class="card text-left">
                            <div class="card-header bg-transparent">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title"> {{__('Privacy and Policy')}}</h3>

                                    </div>
                                    @can('privacy_edit')
                                    <div class="col-6 text-right pp-btn">
                                        <button type="submit" class="btn  btn-primary ">{{__('Save')}}</button>

                                    </div>
                                    @endcan
                                </div>
                                <div>



                                </div>
                            </div>
                            <div class="card-body">


                                <div class=" col-md-12">
                                    <form method="post">
                                        <textarea id="summernote" name="pp">{{$pp}}</textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
@endpush
