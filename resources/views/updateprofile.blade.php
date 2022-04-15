@extends('layouts.app')

@section('content')
    <form class="ml-auto mr-auto" style="width:50%" action="/updatesaveuser" method="post">
        @csrf

        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="email">
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="string" name="phone_number" class="form-control" value="{{ $user->phone_number }}"
                id="phone_number">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="string" class="form-control" id="address" name="address" value="{{ $user->address }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
