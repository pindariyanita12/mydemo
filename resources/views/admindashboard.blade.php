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

                <table class="table table-hover table-fixed table-stripped">
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
                        <?php

                        for ($i = 0; $i < sizeof($users); $i++) {
                            for ($j = 0; $j < sizeof($users[$i]->liters); $j++) {
                                echo '<tr>';
                                echo '<td>' . $users[$i]->id . '</td>';
                                echo '<td>' . $users[$i]->name . '</td>';
                                echo '<td>' . $users[$i]->liters[$j]->date . '</td>';
                                echo '<td>' . $users[$i]->liters[$j]->day . '</td>';
                                echo '<td>' . $users[$i]->liters[$j]->time . '</td>';
                                echo '<td>' . $users[$i]->liters[$j]->liter . '</td>';
                                echo '<td>' . $users[$i]->liters[$j]->rupees . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection
