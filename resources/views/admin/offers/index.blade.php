@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Offers",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Offer List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Offer') }}</h3>
                        </div>
                        @can('offer_create')
                        <div class="col-4 text-right">
                            <a href="{{ route('offers.create') }}"
                                class="btn btn-sm btn-primary">{{ __('Add offers') }}</a>
                        </div>
                        @endcan
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
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Expiry')}}</th>
                                <th>{{__('Maximum Usage par user')}}</th>
                                <th>{{__('Discount')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $cat->title}}</td>
                                <td>@foreach ($cat->branchData as $item)
                                    {{$item->name}},
                                    @endforeach</td>
                                <td>@if ($cat->how_expire == 0)
                                    {{$cat->expiry_date}}
                                    @else
                                    after {{$cat->max_usage}} use
                                    @endif</td>
                                <td>
                                    @if ($cat->max_use_user > 0)
                                    {{$cat->max_use_user}}
                                    @else
                                    Unlimited
                                    @endif
                                </td>
                                <td>
                                    @if ($cat->discount_type == 0)
                                    ${{$cat->discount}}
                                    @else
                                    {{$cat->discount}}%
                                    @endif
                                </td>

                                <td>
                                    @if ($cat->status)
                                    <span class="badge   badge-success m-1">{{__('Active')}}</span>
                                    @else
                                    <span class="badge   badge-warning  m-1">{{__('Disabled')}}</span>

                                    @endif
                                </td>
                                <td class="d-flex">



                                    @can('offer_edit')
                                    <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                        href="{{ route('offers.edit', $cat->id) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                    @endcan
                                    @can('offer_delete')

                                    <form action="{{ route('offers.destroy', $cat) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i></span>
                                        </button>
                                    </form>

                                    @endcan
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
