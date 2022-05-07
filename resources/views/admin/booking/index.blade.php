@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Booking",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Booking List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Booking') }}</h3>
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
                                <th>{{__('User')}}</th>
                                <th>{{__('Branch')}}</th>
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
                                <td>{{$bb->branch->name}}</td>
                                <td>{{$bb->start_time->format('d-m-Y h:m A')}} to {{$bb->end_time->format('h:m A')}}
                                </td>
                                <td>{{$bb->total}}</td>

                                <td>

                                    @if ($bb->payment_status == 0)

                                    <span class="badge badge-danger m-2 p-2">{{__('Un paid')}}</span>

                                    @else
                                    <span class="badge badge-success m-2 p-2">{{__('Paid')}}</span>
                                    @endif
                                </td>


                                <td>
                                    @if ($bb->status == 1)
                                    <span class="badge   badge-success m-1">{{__('Confirm')}}</span>
                                    @elseif($bb->status == 0)
                                    <span class="badge   badge-warning  m-1">{{__('Waiting')}}</span>
                                    @elseif($bb->status == 2)
                                    <span class="badge   badge-default  m-1">{{__('Complete')}}</span>
                                    @else
                                    <span class="badge   badge-danger  m-1">{{__('Cancel')}}</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    @can('booking_edit')
                                    @if ($bb->status == 0)

                                    <form action="{{ route('booking.status', ['id'=>$bb->id,'status'=>1]) }}"
                                        method="get">


                                        <button type="button" class="btn btn-sm btn-outline-success btn-icon m-1"
                                            data-toggle="tooltip" data-placement="bottom"
                                            title="Approved this appointment?"
                                            onclick="confirm('{{ __("Are you sure you want to change status of booking?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="far fa-thumbs-up"></i></span>
                                        </button>
                                    </form>
                                    <form action="{{ route('booking.status', ['id'=>$bb->id,'status'=>5]) }}"
                                        method="get">


                                        <button data-toggle="tooltip" data-placement="bottom"
                                            title="Rejected this appointment?" type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of booking?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="far fa-thumbs-down"></i></span>
                                        </button>
                                    </form>
                                    @endif
                                    @if ($bb->status == 1)
                                    <form action="{{ route('booking.status', ['id'=>$bb->id,'status'=>2]) }}"
                                        method="get">


                                        <button data-toggle="tooltip" data-placement="bottom"
                                            title="Complete this appointment?" type="button"
                                            class="btn btn-sm btn-outline-success btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of booking?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="fas fa-check"></i></span>
                                        </button>
                                    </form>
                                    <form action="{{ route('booking.status', ['id'=>$bb->id,'status'=>3]) }}"
                                        method="get">


                                        <button data-toggle="tooltip" data-placement="bottom"
                                            title="Cancel this appointment?" type="button"
                                            class="btn btn-sm btn-outline-warning btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of booking?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="fas fa-times"></i></span>
                                        </button>
                                    </form>
                                    @endif
                                    @if ($bb->payment_status == 0)
                                    <form action="{{ route('booking.paymentstatus', ['id'=>$bb->id]) }}" method="get">


                                        <button type="button" data-toggle="tooltip" data-placement="bottom"
                                            title="Collect Payment"
                                            class="btn btn-sm btn-outline-primary btn-dribbble btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of booking?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="fas fa-dollar-sign"></i></span>
                                        </button>
                                    </form>
                                    @endif

                                    <a data-toggle="tooltip" data-placement="bottom" title="View Booking?"
                                        class="btn btn-sm btn-outline-primary btn-icon m-1"
                                        href="{{ route('booking.show',$bb) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-print"></i></span>
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
</div>
@endsection
