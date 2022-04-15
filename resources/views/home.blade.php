@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table  class="table table-hover table-fixed table-stripped">
                        <thead class="thead-dark">
                          <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Liters</th>
                            <th>Rupees</th>
                          </tr>
                        </thead>
                        <!--Table head-->

                        <!--Table body-->
                        {{-- <tbody class="table-striped">
                          <?php $counter=1 ?>
                         @foreach($data as $users)
                        <tr>
                            <td></td>
                            <td>{{$users['liters']}}</td>
                        <td>{{$users['liters']}}</td>
                        </tr>

                        @endforeach<tr class="table-info">



                        </tbody> --}}
                        </table>

                </div>

    </div>
</div>
@endsection
