@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Job Posts",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Job Vacancies'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Business Jobs') }}</h3>
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
                                <th>{{__('Title')}}</th>
                                <th>{{__('Field')}}</th>
                                <th>{{__('Created By')}}</th>
                                 <th>{{__('Deadline')}}</th>
                                 <th>{{__('Create Date')}}</th>
                                 <th>{{__('Display')}}</th>
                                 <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($posts) > 0)
                            @foreach ($posts as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $cat->Jobtitle->title}} </td>
                                 <td>{{ $cat->Jobtitle->Businesssector->sector_name}} </td>
                                <td>{{$cat->appuser->name}}</td>
                                <td>{{ \Carbon\carbon::createFromFormat('Y-m-d', $cat->appln_deadline)->format('jS F Y')}} </td>
                                 <td>{{ \Carbon\carbon::createFromFormat('Y-m-d H:i:s', $cat->created_at)->format('jS F Y H:i:s')}} </td>
                                 <td>
                                    @if($cat->show_status == 'Active')
                                        <span class="badge badge-warning  m-1">{{__('Active')}}</span>
                                    @elseif($cat->show_status == 'Inactive')
                                        <span class="badge badge-default  m-1">{{__('Inactive')}}</span>
                                    @endif
                                </td>

                                <td>
                                @if ($cat->status == 'Pending')
                                    <span class="badge badge-primary m-1">{{__('Pending')}}</span>
                                @elseif($cat->status == 'Accepted')
                                    <span class="badge badge-success m-1">{{__('Accepted')}}</span>
                                @elseif($cat->status == 'Rejected')
                                    <span class="badge badge-warning  m-1">{{__('Rejected')}}</span>
                                @endif
                                </td>
                                <td class="d-flex">
                                    <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                        href="{{ route('jobpost.show', $cat->id) }}">
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
