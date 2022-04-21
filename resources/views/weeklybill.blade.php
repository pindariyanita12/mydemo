<table class="table table-hover table-fixed table-stripped">
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
        <?php $sum = 0;?>
        @foreach ($liters as $abc)
            <tr>
                <td>{{ $abc['id'] }}</td>
                <td>{{ $abc['date'] }}</td>
                <td>{{ $abc['day'] }}</td>
                <td>{{ $abc['time'] }}</td>
                <td>{{ $abc['liter'] }}</td>

                <td>{{ $abc['rupees'] }}</td>
            </tr>
            <?php $sum = $sum + $abc['rupees']; ?>
        @endforeach
        <tr class="table-info">
    </tbody>
</table>
<p class="text-center"><?php echo 'Total Rupees:- ' . $sum; ?></p>
