<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <link rel="stylesheet" href="../app/views/css/sass.css"/>
    <link rel="shortcut icon" href="./imgs/logos/logo1.png" type="image/x-icon"/>
  </head>
  <body>
    <div class="container-fluid bg-white">
      <div class="row background"></div>

      <!-- ENCABEZADO -->
      <header>
        <nav class="navbar border-bottom border-secondary">
          <a class="navbar-brand ms-3" href="#">
            <object data="../public//imgs/logos/logo4.svg" type="image/svg+xml" width="30" height="30" class="d-inline-block align-top me-2" alt="Logo perrera">
              <img src="../public/imgs/logos/logo4.svg" alt="Logo perrera"/>
            </object>
            Patas arriba
          </a>
        </nav>
      </header>

      <!-- CONTENIDO -->
      <main class="d-flex flex-column align-items-center justify-content-center mt-5">
        <div class="row justify-content-center">
          <div class="col-10 col-sm-7 col-md-7 col-lg-7 p-3 mb-3 text-center">
            <h3 class="fs-2 fw-light lh-lg">¡Bienvenido! Por favor, inicia sesión para acceder a tu cuenta.</h3>
          </div>
        </div>

        <div class="row justify-content-center align-items-center col-10 col-sm-7 col-md-6 col-lg-3 p-2">
          <form class="login">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" required="required"/>
            </div>

            <div class="form-group mt-4">
              <label for="passwd">Password</label>
              <input type="password" class="form-control" name="passwd" id="passwd" placeholder="************" required="required"/>
            </div>

            <div class="form-group form-check mt-4">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1"/>
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>

            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary px-5">Log in</button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </body>
</html>
