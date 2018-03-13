<!DOCTYPE html>
<html>
  <head>
	<title>Applicants</title>
  </head>
<body>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Adress</th>
        </tr>
        @foreach($applicants as $applicant)
            <tr>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->adress_name}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
