@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Branches",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Branch',
'text'=>'New Branch',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Branch Detail') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('branch.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Image-Text card -->
                            <div class="card">
                                <!-- Card image -->
                                <img class="card-img-top" src="{{ asset('upload') .'/'.$branch->icon}}"
                                    alt="Image placeholder">
                                <!-- Card body -->
                                <div class="card-body">
                                    <h5 class="h2 card-title mb-0">{{$branch->name}}</h5>
                                    <small class="text-muted">{{$branch->address}}</small>
                                    <p class="card-text mt-4">{{$branch->description}}</p>
                                    <small
                                        class="text-muted">{{$branch->start_time . ' to ' .$branch->end_time}}</small>
                                    <hr>
                                    @if ($branch->for_who == 0)

                                    <span class="badge badge-primary m-2 p-2">{{__('Man & Women')}}</span>
                                    @elseif($branch->for_who == 1)
                                    <span class="badge badge-danger m-2 p-2">{{__('Women')}}</span>
                                    @else
                                    <span class="badge badge-default m-2 p-2">{{__('Man')}}</span>
                                    @endif
                                    @if ($branch->is_featured)

                                    <a href="#" class="badge badge-danger m-2 p-2">featured</a>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-8">
                            <ul class="nav nav-pills nav-fill flex-column flex-sm-row mb-4" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="home-basic-tab" data-toggle="tab"
                                        href="#homeBasic" role="tab" aria-controls="homeBasic"
                                        aria-selected="true">Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 " id="home-basic-tab" data-toggle="tab"
                                        href="#contact" role="tab" aria-controls="homeBasic"
                                        aria-selected="true">Employee</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 " id="home-basic-tab" data-toggle="tab"
                                        href="#appInfo" role="tab" aria-controls="homeBasic"
                                        aria-selected="true">Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="profile-basic-tab" data-toggle="tab"
                                        href="#profileBasic" role="tab" aria-controls="profileBasic"
                                        aria-selected="false">Service</a>
                                </li>

                            </ul>
                            <div class="tab-content pb-0" id="myTabContent">
                                <div class="tab-pane fade show active" id="homeBasic" role="tabpanel"
                                    aria-labelledby="home-basic-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive card p-3">
                                                <table id="dataTable" class="table table-flush">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('User')}}</th>

                                                            <th>{{__('Booking Time')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                            <th>{{__('Payment')}}</th>
                                                            <th>{{__('Status')}}</th>
                                                            <th>{{__('Action')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($booking as $bb)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$bb->user->name}}</td>

                                                            <td>{{$bb->start_time->format('d-m-Y h:m A')}} to
                                                                {{$bb->end_time->format('h:m A')}}
                                                            </td>
                                                            <td>{{$bb->total}}</td>

                                                            <td>

                                                                @if ($bb->payment_status == 0)

                                                                <span
                                                                    class="badge badge-danger m-2 p-2">{{__('Un paid')}}</span>

                                                                @else
                                                                <span
                                                                    class="badge badge-success m-2 p-2">{{__('Paid')}}</span>
                                                                @endif
                                                            </td>


                                                            <td>
                                                                @if ($bb->status == 1)
                                                                <span
                                                                    class="badge   badge-success m-1">{{__('Confirm')}}</span>
                                                                @elseif($bb->status == 0)
                                                                <span
                                                                    class="badge   badge-warning  m-1">{{__('Waiting')}}</span>
                                                                @elseif($bb->status == 2)
                                                                <span
                                                                    class="badge   badge-default  m-1">{{__('Complete')}}</span>
                                                                @else
                                                                <span
                                                                    class="badge   badge-danger  m-1">{{__('Cancel')}}</span>
                                                                @endif
                                                            </td>
                                                            <td class="d-flex">
                                                                @can('booking_edit')
                                                                @if ($bb->status == 0)

                                                                <form
                                                                    action="{{ route('booking.status', ['id'=>$bb->id,'status'=>1]) }}"
                                                                    method="get">


                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-success btn-icon m-1"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Approved this appointment?"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="far fa-thumbs-up"></i></span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('booking.status', ['id'=>$bb->id,'status'=>5]) }}"
                                                                    method="get">


                                                                    <button data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Rejected this appointment?" type="button"
                                                                        class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="far fa-thumbs-down"></i></span>
                                                                    </button>
                                                                </form>
                                                                @endif
                                                                @if ($bb->status == 1)
                                                                <form
                                                                    action="{{ route('booking.status', ['id'=>$bb->id,'status'=>2]) }}"
                                                                    method="get">


                                                                    <button data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Complete this appointment?" type="button"
                                                                        class="btn btn-sm btn-outline-success btn-icon m-1"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="fas fa-check"></i></span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('booking.status', ['id'=>$bb->id,'status'=>3]) }}"
                                                                    method="get">


                                                                    <button data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Cancel this appointment?" type="button"
                                                                        class="btn btn-sm btn-outline-warning btn-icon m-1"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="fas fa-times"></i></span>
                                                                    </button>
                                                                </form>
                                                                @endif
                                                                @if ($bb->payment_status == 0)
                                                                <form action="" method="get">

                                                                    @method('delete')
                                                                    <button type="button" data-toggle="tooltip"
                                                                        data-placement="bottom" title="Collect Payment"
                                                                        class="btn btn-sm btn-outline-primary btn-dribbble btn-icon m-1"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="fas fa-dollar-sign"></i></span>
                                                                    </button>
                                                                </form>
                                                                @endif

                                                                <a data-toggle="tooltip" data-placement="bottom"
                                                                    title="View Booking?"
                                                                    class="btn btn-sm btn-outline-primary btn-icon m-1"
                                                                    href="{{ route('booking.show',$bb) }}">
                                                                    <span class="ul-btn__icon"><i
                                                                            class="fas fa-print"></i></span>
                                                                </a>


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
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="home-basic-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive card p-3">
                                                <table id="dataTable" class="table table-flush">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('Name')}}</th>
                                                            <th>{{__('Email')}}</th>
                                                            <th>{{__('Address')}}</th>
                                                            <th>{{__('Image')}}</th>
                                                            <th>{{__('Status')}}</th>
                                                            <th>{{__('Action')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($employee as $cat)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td> {{$cat->user->name}}
                                                            </td>
                                                            <td>{{ $cat->user->email}}</td>
                                                            <td>{{ $cat->address}}</td>
                                                            <td>
                                                                <div
                                                                    class="profile-picture avatar-sm mb-2 rounded-circle bg-primary text-center">

                                                                    <img class="mt-2 img-fluid"
                                                                        src="{{ asset('upload') .'/'.$cat->icon}}"
                                                                        alt="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if ($cat->status)
                                                                <span
                                                                    class="badge   badge-success m-1">{{__('Active')}}</span>
                                                                @else
                                                                <span
                                                                    class="badge   badge-warning  m-1">{{__('Disabled')}}</span>

                                                                @endif
                                                            </td>
                                                            <td class="d-flex">


                                                                <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                                                    href="{{ route('employee.edit', $cat->id) }}">
                                                                    <span class="ul-btn__icon"><i
                                                                            class="far fa-eye"></i></span>
                                                                </a>
                                                                @can('employee_edit')
                                                                <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                                                    href="{{ route('employee.edit', $cat->id) }}">
                                                                    <span class="ul-btn__icon"><i
                                                                            class="fas fa-pencil-alt"></i></span>
                                                                </a>
                                                                @endcan
                                                                @can('employee_delete')

                                                                <form action="{{ route('employee.destroy', $cat) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                                        <span class="ul-btn__icon"><i
                                                                                class="far fa-trash-alt"></i></span>
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
                                <div class="tab-pane fade" id="appInfo" role="tabpanel"
                                    aria-labelledby="home-basic-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive card p-3">
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


                                                            <td>@for ($i = 1; $i <= 5; $i++) <i
                                                                    class="fas fa-star {{$i <= $cat->star ? 'activeStar' : ''}}">
                                                                    </i>
                                                                    @endfor</td>
                                                            <td>{{ $cat->cmt}}</td>

                                                            <td class="d-flex">


                                                                <a class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                                    href="{{ route('review.delete', $cat->id) }}">
                                                                    <span class="ul-btn__icon"><i
                                                                            class="far fa-trash-alt"></i></span>
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
                                <div class="tab-pane fade" id="profileBasic" role="tabpanel"
                                    aria-labelledby="home-basic-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive card p-3">
                                                <table id="dataTable" class="table table-flush">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>

                                                            <th>{{__('Category')}}</th>
                                                            <th>{{__('Service')}}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($service ?? [] as $cat)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>

                                                            <td>{{ $cat->name}}
                                                            </td>
                                                            <td>
                                                                @foreach ($cat['service'] as $item)
                                                                <span
                                                                    class="badge badge-primary m-2 p-2">{{$item->name}}</span>
                                                                @endforeach



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
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
