<!DOCTYPE html>
<html>
  <head>
    <title>Prefernce {{ $preference->prid }}</title>
  </head>
  <body>
    <h1>Prefernce {{ $preference->prid }}</h1>
    <ul>
        <li>ID from: {{ $preference->id_from }}</li>
        <li>ID to: {{ $preference->id_to }}</li>
        <li>Preference kind: {{ $preference->pr_kind }}</li>
        <li>Rank: {{ $prefernce->rank }}</li>
        <li>Active: {{ $preference->active }}</li>
    </ul>
  </body>
</html>