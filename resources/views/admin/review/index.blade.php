@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Review",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Review List'
])))
<style>
    .activeStar {
        color: goldenrod
    }

</style>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Review') }}</h3>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Star')}}</th>
                                <th>{{__('Comment')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $cat->user->name}}

                                </td>
                                <td>{{ $cat->branch->name}}

                                </td>

                                <td>@for ($i = 1; $i <= 5; $i++) <i
                                        class="fas fa-star {{$i <= $cat->star ? 'activeStar' : ''}}">
                                        </i>
                                        @endfor</td>
                                <td>{{ $cat->cmt}}</td>

                                <td class="d-flex">


                                    <a class="btn btn-sm btn-outline-danger btn-icon m-1"
                                        href="{{ route('review.delete', $cat->id) }}">
                                        <span class="ul-btn__icon"><i class="far fa-trash-alt"></i></span>
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
