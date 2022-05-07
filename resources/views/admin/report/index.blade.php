@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Report",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Report'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-1">{{ __('Report') }}</h3>

                            <form action="{{route('report.create')}}" method="POST">
                                @csrf
                                <div class="form-row ">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('From:')}}</label>
                                        <input type="date" value="{{ $req['from'] ?? '' }}" name="from"
                                            class="form-control  @error('from') invalid-input @enderror" autofocus>

                                        @error('from')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('To:')}}</label>
                                        <input type="date" name="to" value="{{ $req['to'] ?? '' }}"
                                            class="form-control  @error('to') invalid-input @enderror">

                                        @error('to')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('Branch:')}}</label>
                                        <select class="js-example-basic form-control" name="branch">

                                            <option value="branch_id">All
                                            </option>
                                            @foreach ($branch as $item)
                                            <option value="{{ $item['id']}}">{{ $item['name']}}
                                            </option>
                                            @endforeach


                                        </select>
                                        @error('to')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('User:')}}</label>
                                        <select class="js-example-basic form-control" name="user">

                                            <option value="user_id">All
                                            </option>
                                            @foreach ($user as $item)
                                            <option value="{{ $item['id']}}">{{ $item['name']}}
                                            </option>
                                            @endforeach


                                        </select>
                                        @error('to')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('Employee:')}}</label>
                                        <select class="js-example-basic form-control" name="emp">

                                            <option selected value="emp_id">All
                                            </option>
                                            @foreach ($employee as $item)
                                            <option value="{{ $item['id']}}">{{ $item['name']}}
                                            </option>
                                            @endforeach


                                        </select>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" class="ul-form__label">{{__('Status:')}}</label>
                                        <select class="js-example-basic form-control" name="status">

                                            <option selected value="status">All
                                            </option>
                                            <option value="1">Confirm
                                            </option>

                                            <option value="0">Waiting
                                            </option>

                                            <option value="2">Complete
                                            </option>

                                            <option value="3">Cancel
                                            </option>



                                        </select>

                                    </div>
                                    <div class="form-group col-md-8 mt-4">

                                        <button type="submit" class="btn  btn-primary m-1">{{__('Search')}}</button>
                                        <button type="reset" class=" btn   btn-secondary m-1">{{__('Reset')}}</button>

                                    </div>

                                </div>
                            </form>
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
                                <th>{{__('User Name')}}</th>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Booking id')}}</th>
                                <th>{{__('Services - Employee')}}</th>
                                <th>{{__('Booking Date')}}</th>
                                <th>{{__('Status')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($master ?? [] as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user}}</td>
                                <td>{{$item->branch}}</td>
                                <td>{{$item->booking_id}}</td>
                                <td>
                                    @foreach ($item->child_booking as $cb)
                                    {{$cb->service->name .'- ('. $cb->employee->name.')'}} ,
                                    @endforeach
                                </td>
                                <td>
                                    {{date("d-m-Y", strtotime($item->start_time))}}
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                    <span class="badge   badge-success m-1">{{__('Confirm')}}</span>
                                    @elseif($item->status == 0)
                                    <span class="badge   badge-warning  m-1">{{__('Waiting')}}</span>
                                    @elseif($item->status == 2)
                                    <span class="badge   badge-default  m-1">{{__('Complete')}}</span>
                                    @else
                                    <span class="badge   badge-danger  m-1">{{__('Cancel')}}</span>
                                    @endif
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
