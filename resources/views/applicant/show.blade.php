<!DOCTYPE html>
<html>
  <head>
    <title>Applicant {{ $applicant->aid }}</title>
  </head>
  <body>
    <h1>Applicant {{ $applicant->aid }}</h1>
    <ul>
      <li>First Name: {{ $applicant->first_name }}</li>
      <li>Last Name: {{ $applicant->last_name }}</li>
    </ul>
  </body>
</html>