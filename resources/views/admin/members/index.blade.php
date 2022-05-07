@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"members",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Members List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Members</h3>
                        </div>
                        @can('employee_create')
                        <div class="col-4 text-right">
                            <a href="{{ route('members.create') }}"
                                class="btn btn-sm btn-primary">Add Member</a>
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
                                 <th>Member No</th>
                                <th>Town</th>
                                <th>Contact</th>
                                <th>Native</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> {{$cat->firstname}} {{$cat->midname}} {{$cat->surname}}
                                </td>
                                 <td> {{$cat->unique_id}}</td>
                               <td> {{$cat->Town->town_name}}</td>
                               <td> {{$cat->mobile}}</td>
                                <td> {{$cat->Native->native_name}}</td>


                                <td>
                                <div class="profile-picture avatar-sm mb-2 rounded-circle bg-primary text-center">
                                    <img class="mt-2 img-fluid" src="{{ asset('upload') .'/'.$cat->photo_url}}" alt="">
                                </div>
                                </td>
                                <td>
                                    @if ($cat->status)
                                    <span class="badge   badge-success m-1">{{__('Active')}}</span>
                                    @else
                                    <span class="badge   badge-warning  m-1">{{__('Disabled')}}</span>

                                    @endif
                                </td>
                                <td class="d-flex">


                                    <a class="btn btn-sm btn-outline-default btn-icon m-1"
                                        href="{{ route('member.edit', $cat->user_id) }}">
                                        <span class="ul-btn__icon"><i class="far fa-eye"></i></span>
                                    </a>

                                    <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                        href="{{ route('member.edit', $cat->user_id) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>



                                    <form action="{{ route('member.destroy', $cat->user_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i></span>
                                        </button>
                                    </form>


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
