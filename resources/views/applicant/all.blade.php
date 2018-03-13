<!DOCTYPE html>
<html>
  <head>
	<title>Applicant</title>
  </head>
<body>
    @foreach($applicants as $applicant)
        {{$applicant->first_name}}
    @endforeach
</body>
</html>
