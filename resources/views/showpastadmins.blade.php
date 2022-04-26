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
                            <th>Customer Name</th>
                            <th>Deleted At</th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody class="table-striped">
                        <?php $counter = 1; ?>
                        @foreach ($liters as $abc)
                            <tr>

                                <td>{{ $abc['id'] }}</td>
                                <td>{{ $abc['name'] }}</td>
                                <td>{{ $abc['deleted_at'] }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection
