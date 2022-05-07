@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Lead Center",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Hot Deals'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Hot Deals') }}</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('hotdeals.create') }}"
                                class="btn btn-sm btn-info">{{ __('Add Advertisement') }}</a>
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
                                <th>{{__('Subject')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Alert')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotdeal as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if ($cat->is_featured == 'yes')
                                        <span class="badge badge-warning m-2 p-2">{{ $cat->name}}</span>
                                    @else
                                        {{ $cat->name}}
                                    @endif
                                </td>
                                <td>{{\Carbon\carbon::createFromFormat('Y-m-d', $cat->start_date)->format('jS F Y')}} </td>
                                <td>{{\Carbon\carbon::createFromFormat('Y-m-d', $cat->end_date)->format('jS F Y')}}</td>
                                <td>
                                    @if ($cat->end_date < \Carbon\carbon::today()->format('Y-m-d') && (($cat->is_featured == 'yes') || ($cat->status=='Active')))
                                        <span style="font-size: 18px; font-weight:bolder; color:crimson;">!</span>
                                    @else
                                        <i class="fas fa-check text-success"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="profile-picture avatar-sm mb-2 rounded-circle bg-primary text-center">

                                        <img class="mt-2 img-fluid" src="{{ asset('upload') .'/'.$cat->icon}}" alt="">
                                    </div>
                                </td>
                                <td>
                                    @if ($cat->status=='Active')
                                        <span class="badge   badge-success m-1">{{__('Active')}}</span>
                                    @else
                                        <span class="badge   badge-warning  m-1">{{__('Disabled')}}</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                        href="{{ route('hotdeals.show', $cat->id) }}">
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
