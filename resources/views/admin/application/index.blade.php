@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Membership Applications",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Applications'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Applications') }}</h3>
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
                                <th>{{__('Member Type')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Native')}}</th>
                                <th>{{__('Nationality')}}</th>
                                <th>{{__('Appln Status')}}</th>
                                <th>{{__('View')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($applications) > 0)
                                @foreach($applications as $app)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$app->member_type}}
                                    </td>
                                    <td>
                                        {{$app->firstname}} {{$app->midname}} {{$app->surname}}
                                    </td>
                                    <td>
                                        {{$app->Native->native_name}}
                                    </td>
                                    <td>
                                        {{$app->Country->country_name}}
                                    </td>
                                    <td>
                                        @if ($app->application_status == 'Accepted')
                                        <span class="badge badge-success">{{$app->application_status}}</span>
                                        @elseif($app->application_status == 'Rejected')
                                        <span class="badge badge-danger">{{$app->application_status}}</span>
                                        @elseif($app->application_status == 'Pending')
                                        <span class="badge badge-info">{{$app->application_status}}</span>
                                        @endif

                                    </td>
                                    <td class="d-flex">
                                        <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                            href="{{ route('application.show', $app->user_id) }}">
                                            <span class="ul-btn__icon"><i class="far fa-eye"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

