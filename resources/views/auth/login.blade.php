<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      /* background-color: #007bff; */
      margin: 0;
      height: 100vh;
    }
    .login-container {
      width: 100%;
      width: 550px;
      margin: auto;
      padding: 2rem;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .btn-primary:hover {
      background-color: #003d80;
      border-color: #003d80;
    }
    .alert {
      border-radius: 0.5rem;
    }
    .logo {
      font-size: 2rem;
      color: #fff;
      font-weight: 700;
      text-align: center;
    }
    .form-control {
      width: 100%;
    }
    img {
      width: 100px;
      height: 100px;
      display: block;
      margin: 0 auto;
    }
  </style>
</head>
<body class="bg-info">
  <section class="vh-100 d-flex justify-content-center align-items-center">
    <div class="login-container">
      <div class="card">
        <div class="card-body p-5">
          <img src="assets/images/e-learning.svg" class="mb-3" alt="E-Learning">
          <h1 class="logo mb-4 text-info">LearnClass</h1>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-info btn-block text-white">Masuk</button>
            </div>
            @if ($errors->any())
              <div class="alert alert-danger mt-3" role="alert">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9luI47ZB04fwLw4oCDJxL5AuUueS1ntQU3Ph5bM0JrXbJbgVW4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-GLhlTQvY3MbTw3UMD/24vKnT9OHf2TnH1UMy8PSg3TPGM2c5sMYq7B9wH3HQ8YF" crossorigin="anonymous"></script>
  <script src="assets/js/login.js"></script>
</body>
</html>
