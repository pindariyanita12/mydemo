Hi <br />
Your Monthly bill is: <br>
{{ $data1['name'] }}
{{ $data1['total'] }}

<br>
<a href="{{ 'http://127.0.0.1:8000/checkout/' . $data1['email'] .'/total'.'/' .$data1['total'] }}">Click here to pay</a>
{{-- This is Test Mail.<br />
Thank you !! --}}
{{-- <table class="table table-hover table-fixed table-stripped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
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

        @foreach ($user as $abc)
            <tr>


                <td>{{ $abc->rupees }}</td>
            </tr>

        @endforeach
        <tr class="table-info">
    </tbody>
</table>
<p class="text-center">

</p> --}}
