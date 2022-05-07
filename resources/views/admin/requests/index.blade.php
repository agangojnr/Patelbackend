@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Request for Assistance",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Request for Assistance'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Requests') }}</h3>
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
                                <th>{{__('Date')}}</th>
                                <th>{{__('Sender')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($requests) > 0)
                                @foreach ($requests as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ \Carbon\carbon::createFromFormat('Y-m-d', $item->date)->format('jS F Y')}} </td>
                                    <td>{{ $item->user->name}} </td>
                                    <td>{{ $item->category}} </td>
                                    <td>
                                        @if ($item->status == "Pending")
                                            <span class="badge badge-info">{{ $item->status}}</span>
                                        @elseif($item->status == "Accepted")
                                            <span class="badge badge-success">{{ $item->status}}</span>
                                        @elseif($item->status == "Rejected")
                                            <span class="badge badge-danger">{{ $item->status}}</span>
                                        @endif

                                    </td>
                                    <td class="d-flex">
                                        <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                            href="{{ route('requests.show', $item->id) }}">
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

