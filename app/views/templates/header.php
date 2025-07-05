  <?php
  if (!isset($_SESSION['auth'])) {
      header('Location: /login');
      exit;
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COSC 4806</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-..."
      crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="/home">COSC4806</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/notes">Reminders</a></li>
          <li class="nav-item"><a class="nav-link" href="/notes/create">Create Reminder</a></li>
          <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">
