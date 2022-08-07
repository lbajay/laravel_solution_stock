@extends('backend.layouts.app2')

@section('title', app_name() . ' | ' . __('labels.backend.access.stores.management'))

@section('custom-indexction')

<ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>

                                    <li class="breadcrumb-item active">Store Management</li>
                    
        <li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown show">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Stores</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 21px, 0px);">
                <a class="dropdown-item" href="/admin/stores/create">Create Store</a>
            </div>
        </div>
        <!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div>
    <!--btn-group-->
</li>    </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Stores Management') }} <small class="text-muted"></small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
        {{-- start alert message --}}
        @if(Session::has('error'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ Session::get('error') }}
                            @php
                                Session::forget('error');
                            @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
        @endif
                @if(Session::has('success'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
        @endif
        {{-- end alert  message --}}

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">

             <table id="storesTable" class="table" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td>{{$store->id}}</td>
                                    <td>{{$store->name}}</td>
                                    <td>{{$store->email}}</td>
                                    <td>{{$store->location}}</td>
                                    <td>@if($store->status == 1)Enable @else Disable @endif </td>
                                    <td>{{$store->created_at}}</td>
                                    <td>
                                        <a href="/admin/stores/{{$store->id}}/view" class="btn"><i class="fa fa-eyes"></i></a>
                                        <a href="/admin/stores/{{$store->id}}/edit" class="btn"><i class="fa fa-edit"></i></a>
                                        <a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to delete this?" onclick="$(this).find(&quot;form&quot;).submit();" class="btn btn-flat btn-default" style="cursor:pointer;"><i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>
                                             <form action="/admin/stores/{{$store->id}}" method="POST" name="delete_item" style="display: none;"><input type="hidden" name="_method" value="delete"> @csrf </form></a>
                                    



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
  $('#storesTable').DataTable();
</script>

@stop
