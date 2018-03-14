<!DOCTYPE html>
<html>
  <head>
	<title>Matches</title>
  </head>
<body>
    <table>
        <tr>
            <th>Applicant</th>
            <th>College</th>
        </tr>
        @foreach($matches as $match)
            <tr>
                <td>{{$preference->aid}}</td>
                <td>{{$preference->pid}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
