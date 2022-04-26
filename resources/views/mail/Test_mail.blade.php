Hi <br />
Your Monthly bill is: <br>
{{ $data1['name'] }}
{{ $data1['total'] }}

<br>
<a href="{{ 'http://127.0.0.1:8000/checkout/' . $data1['email'] .'/total'.'/' .$data1['total'] }}">Click here to pay</a>
