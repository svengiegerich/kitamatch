<!DOCTYPE html>
<html>
  <head>
    <title>Preference {{ $preference->prid }}</title>
  </head>
  <body>
    <h1>Preference {{ $preference->prid }}</h1>
    <ul>
        <li>ID from: {{ $preference->id_from }}</li>
        <li>ID to: {{ $preference->id_to }}</li>
        <li>Preference kind: {{ $preference->pr_kind }}</li>
        <li>Rank: {{ $preference->rank }}</li>
        <li>Active: {{ $preference->active }}</li>
    </ul>
  </body>
</html>