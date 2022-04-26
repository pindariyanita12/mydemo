@extends('layouts.app')

@section('content')
    <form class="ml-auto mr-auto" style="width:50%" action="/add" method="post">
        @csrf
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="date">
        </div>
        <div class="form-group">
            <label for="">Day</label>
            <input type="text" name="day" class="form-control" value="<?php echo date('l'); ?>" id="day">
        </div>
        <div class="form-group">
            <label for="">Time</label>
            <input type="text" name="time" class="form-control" value="<?php date_default_timezone_set('Asia/Kolkata');
echo date('h:i:s A'); ?>" id="time">
        </div>
        <div class="form-group ">

            <input type="hidden" name="area" class="form-control" value="{{ auth()->user()->area }}" id="date">
        </div>
        <div class="form-group ">

            <input type="hidden" name="price" class="form-control"  id="price">
        </div>
        <div class="form-group">
            <label for="liters">Add today's Liters</label>
            <input type="text" class="form-control" id="liter" name="liter">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
