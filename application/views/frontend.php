<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- Font Google -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;700&display=swap" rel="stylesheet" />

  <!-- My CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/style.css" />

  <!-- Icon Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />

  <!-- CSS Steper -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/bs-stepper.min.css" />

  <title><?= $title ?> | <?= $company['company_name'] ?> | <?= $company['sub_name'] ?></title>
</head>

<body>
  <!-- Navbar -->
  <!-- Navbar atas -->
  <nav class="navbar navbar-expand navbar-light bg-primary">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link small text-white active" href="#"><i class="bi bi-instagram"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link small text-white" href="<?= $company['facebook'] ?>"><i class="bi bi-facebook"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link small text-white" href="<?= $company['twitter'] ?>"><i class="bi bi-twitter"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link small text-white" href="#"><i class="bi bi-youtube"></i></a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link small text-white active" href="#"><?= $company['whatsapp'] ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link small text-white" href="#"><?= $company['email'] ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar bawah -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="<?= base_url("front") ?>">
        <img class="img-fluid" width="200"  src="<?= base_url('assets/images/' . $company['logo']) ?>" alt="">
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <p class="m-0"><i class="bi bi-list"></i>MENU</p>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url("front") ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("front/about") ?>">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("front/status") ?>">Status</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->

  <?= $contents ?>

  <!-- Footer -->
  <!-- Contact -->
  <section class="pt-5 bg-light" id="contact">
    <div class="container py-5 text-dark">
      <div class="row">
        <div class="col text-center">
          <h2 class="fw-bolder">Hubungi kami jika ada masalah atau pertanyann</h2>
          <p class="py-3">
            <?= $company['description'] ?>
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-3 text-center">
          <p><i class="pe-2 bi bi-telephone"></i><?= $company['whatsapp'] ?></p>
        </div>
        <div class="col-lg-3 text-center">
          <p><i class="pe-2 bi bi-whatsapp"></i><?= $company['whatsapp'] ?></p>
        </div>
        <div class="col-lg-3 text-center">
          <p><i class="pe-2 bi bi-envelope-open"></i><?= $company['email'] ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- ./Contact -->

  <!-- Footer -->
  <footer class="bg-primary">
    <div class="container text-white">
      <div class="row py-5">
        <div class="col-lg py-2">
          <h5 class="fw-bold">SOSIAL.NET</h5>
          <p><?= $company['description'] ?></p>
        </div>
        <div class="col-lg py-2">
          <p class="fw-bold">About Us</p>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white p-0 my-1 small" href="#">Service</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white p-0 my-1 small" href="#">Portofolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white p-0 my-1 small" href="#">Contact Us</a>
            </li>
          </ul>
        </div>
        <div class="col-lg py-2">
          <p class="fw-bold">Contact Us</p>
          <ul class="navbar-nav">
            <li class="nav-item">
              <p class="small"><?= $company['company_name'] ?></p>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white p-0 my-1 small" href="#">Phone: <?= $company['whatsapp'] ?></a>
              <a class="nav-link text-white p-0 my-1 small" href="#">Phone: <?= $company['whatsapp'] ?></a>
            </li>
          </ul>
        </div>
        <div class="col text-end mt-auto">
          <a href="<?= $company['facebook'] ?>"><i class="h3 mx-2 text-white bi bi-facebook"></i></a>
          <a href="<?= $company['instagram'] ?>"><i class="h3 mx-2 text-white bi bi-instagram"></i></a>
          <a href="#"><i class="h3 mx-2 text-white bi bi-tiktok"></i></a>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row border-top">
        <div class="col text-center">
          <p class="py-3 m-0 text-white">Copyright &copy; <?= date('Y') ?> Developed With &#10084;</a></p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Akhir Footer -->
  <!-- Footer Akhir -->

  <!-- JS Stepper -->
  <script src="<?= base_url('assets/frontend/') ?>js/bs-stepper.min.js"></script>
  <script src="<?= base_url('assets/frontend/') ?>js/main.js"></script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>