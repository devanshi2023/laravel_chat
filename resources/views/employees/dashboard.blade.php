@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="card">
    <!---messages--->
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block" id="alert">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>{{$message}}</strong>
    </div>
    @endif
    @if($message = Session::get('error'))
    <div class="alert alert-danger alert-block" id="alert">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="container-fluid">
      <div class="flex">
        <div class="text-left">
          <h4 style="color: #333;">Users</h4>
        </div>
        <form class="right" id="search-form" style="padding: 10px;">
          <div class="form-group">
            <input type="text" placeholder="Search here..." id="search" pattern="[A-Za-z0-9.]{2,}" value="{{isset($search) ? $search : ''}}" title="Please enter at least two letters" name="search" autocomplete="off" style="width: 80%;">
            <button type="submit"  style="border: none; background-color: grey; color: white; padding: 3px 7px; cursor: pointer;"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Sno.</th>
            <th>Profile</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($employees) > 0)
          @foreach($employees as $emp)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>
              <img src="{{asset('profile/'.$emp->image) }}" class="rounded-circle" width="50" height="50" alt="">
            </td>
            <td>{{ucfirst(trans($emp->name))}}</td>
            <td>
              <a href="{{ route('user.chat', ['userId' => $emp->id]) }}" class="btn btn-secondary btn-small">Chat</a>
            </td>
          </tr>
          @endforeach
          @else
          <td colspan="10">
            <div class="alert alert-danger text-center">No data found!</div>
          </td>
          @endif
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection