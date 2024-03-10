@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container p-3">
        <div class="card mt-3 p-3">
            <form method="POST" action="{{route('emp.update',$employee['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <img src="/profile/{{$employee->image}}" class="rounded mt-2" id="edit_image" width="200px;" height="170">
                </div>
                <!--employee name input-->
                <div class="form-group">
                    <label>Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name',ucfirst(trans($employee['name'])))}}">
                    @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <!--employee email input-->
                <div class="form-group">
                    <label>Email :</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{old('email',$employee['email'])}}">
                    @if($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <!--employee image input-->
                <div class="form-group">
                    <label>Profile :</label>
                    <input type="file" id="uploadImage" name="image" class="form-control">
                    @if($errors->has('image'))
                    <span class="text-danger">{{$errors->first('image')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection