@extends('layouts.app')
@push('css')
<link type="text/css" href="{{ asset('argon') }}/css/invoice.css" rel="stylesheet">
@endpush
@section('content')

@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Booking",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Booking List',
'text'=>'Booking',
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
                        <div class="col-4 text-right">
                            <a class="btn btn-sm btn-primary text-white"
                                onclick="printDiv('#printableArea')">{{ __('Print') }}</a>
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

                <div class="invoice-box" id="printableArea">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            <img class="img-own"
                                                src="{{ asset('upload') .'/'.$bookingMaster->branch->icon}}">
                                        </td>

                                        <td>
                                            Invoice #: {{$bookingMaster->booking_id}}<br>
                                            Start Time: {{$bookingMaster->start_time->format('F d,Y h:m A')}}<br>
                                            End Time: {{$bookingMaster->end_time->format('F d,Y h:m A')}}<br>
                                            Status: <b> @if ($bookingMaster->status == 1)
                                                {{__('Confirm')}}
                                                @elseif($bookingMaster->status == 0)
                                                {{__('Waiting')}}
                                                @elseif($bookingMaster->status == 2)
                                                {{__('Complete')}}
                                                @else
                                                {{__('Cancel')}}
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            {{$bookingMaster->branch->name}}<br>
                                            {{$bookingMaster->branch->address}}<br>

                                        </td>

                                        <td>
                                            {{$bookingMaster->user->name}}<br>
                                            {{$bookingMaster->user->email}}<br>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Payment Method
                            </td>

                            <td>
                                Payment Status
                            </td>
                        </tr>

                        <tr class="details">
                            <td>
                                {{$bookingMaster->payment_method}} <br>
                                {{$bookingMaster->payment_token}}
                            </td>

                            <td>
                                {{$bookingMaster->payment_status == 0 ? 'Un-Paid' : 'Paid'}}
                            </td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Service (Employee)
                            </td>

                            <td>
                                Duration
                            </td>
                        </tr>
                        @foreach ($bookingMaster->services as $item)

                        <tr class="item">
                            <td>
                                {{$item->service->name}} ({{$item->employee->name}})
                            </td>

                            <td>
                                {{$item->duration}}
                            </td>
                        </tr>
                        @endforeach

                        <tr class="">
                            <td></td>

                            <td>
                                Discount: {{$bookingMaster->currency}}{{$bookingMaster->discount}}
                            </td>
                        </tr>
                        <tr class="total">
                            <td></td>

                            <td>
                                Total:{{$bookingMaster->currency}}{{$bookingMaster->total}}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
