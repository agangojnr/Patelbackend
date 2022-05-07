@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Business Profiles",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Community Businesses'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Businesses with the Community') }}</h3>
                        </div>

                        <div class="col-4 text-right">
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
                <div class="table-responsive">
                    <table id="dataTable" class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Business Name')}}</th>
                                <th>{{__('Contact')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($businessjob as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $cat->Businesssector->sector_name}} </td>
                                 <td>{{ $cat->business_name}} </td>
                                <td> {{$cat->contact}}</td>
                                <td>
                                    @if ($cat->status == 'Accepted')
                                        <span class="badge badge-success">{{$cat->status}}</span>
                                    @elseif($cat->status == 'Rejected')
                                        <span class="badge badge-danger">{{$cat->status}}</span>
                                    @elseif($cat->status == 'Pending')
                                        <span class="badge badge-info">{{$cat->status}}</span>
                                    @endif
                                </td>

                                <td class="d-flex">
                                    <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                        href="{{ route('business.show', $cat->id) }}">
                                        <span class="ul-btn__icon"><i class="far fa-eye"></i></span>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


