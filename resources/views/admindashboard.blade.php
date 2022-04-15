
@extends('layouts.adminapp')

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
                            <th>Id</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Liters</th>
                            <th>Rupees</th>
                          </tr>
                        </thead>
                        <!--Table head-->

                        <!--Table body-->
                        <tbody class="table-striped">
                          <?php $counter=1 ?>
                         @foreach($liters as $abc)

                         <tr>

                            <td>{{$abc['id']}}</td>
                            <td>{{$abc->user->name}}</td>

                            <td>{{$abc->date}}</td>
                            <td>{{$abc->day}}</td>
                            <td>{{$abc->time}}</td>

                        <td>{{$abc->liter}}</td>
                        <td>{{$abc->rupees}}</td>

                        </tr>

                        @endforeach
                        <tr class="table-info">



                        </tbody>
                        </table>

                </div>

    </div>
</div>
@endsection
