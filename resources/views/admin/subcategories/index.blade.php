@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Vaccines",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Vaccines'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Vaccines') }}</h3>
                        </div>
                        @can('subcategory_create')
                        <div class="col-4 text-right">
                            <a href="{{ route('subcategories.create') }}"
                                class="btn btn-sm btn-danger">{{ __('Add new') }}</a>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Price')}}</th>
                               <!-- <th>{{__('Service For')}}</th>
                                <th>{{__('Duration (min)')}}</th>
                                <th>{{__('Preparation Time (min)')}}</th>-->

                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $subcategory->name}}
                                   
                                </td>
                                <td>
                                    {{ $subcategory->category->name}}
                                </td>

                                <td>
                                    {{ $subcategory->description}}
                                </td>
                                <td>
                                   {{ $subcategory->price}}
                                </td>

                               <!-- <td>

                                    @if ($subcategory->for_who == 0)

                                    <span class="badge badge-primary m-2 p-2">{{__('Man & Women')}}</span>
                                    @elseif($subcategory->for_who == 1)
                                    <span class="badge badge-danger m-2 p-2">{{__('Women')}}</span>
                                    @else
                                    <span class="badge badge-default m-2 p-2">{{__('Man')}}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $subcategory->duration}}
                                </td>
                                <td>
                                    {{ $subcategory->preparation_time}}
                                </td>-->

                                <td>
                                    @if ($subcategory->status)
                                    <span class="badge  badge-success m-1">{{__('Active')}}</span>
                                    @else
                                    <span class="badge  badge-warning  m-1">{{__('Disabled')}}</span>

                                    @endif
                                </td>
                                <td class="d-flex">

                                    @can('subcategory_edit')
                                    <a class="btn btn-outline-info btn-icon m-1 btn-sm"
                                        href="{{ route('subcategories.edit', $subcategory->id) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                    @endcan
                                    @can('subcategory_delete')

                                    <form action="{{ route('subcategories.destroy', $subcategory) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-outline-danger btn-icon m-1 btn-sm"
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
