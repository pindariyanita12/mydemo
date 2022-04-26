@extends('layouts.superadmin')

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
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Area</th>
                            <th>Total Customers</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody class="table-striped">
                        <?php $counter = 1; ?>
                        @foreach ($admins as $abc)
                            <tr>

                                <td>{{ $abc['id'] }}</td>
                                <td>{{ $abc->name }}</td>

                                <td>{{ $abc->email }}</td>
                                <td>{{ $abc->phone_number }}</td>
                                <td>{{ $abc->area }}</td>
                                <td><a href="{{ 'showalladmindashboard/' . $abc['area'] }}">View</a></td>
                                <td><a href={{ 'deleteadmin/' . $abc['id'] }}>Delete</a></td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection
