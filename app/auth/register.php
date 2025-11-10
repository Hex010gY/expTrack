<?php
require_once __DIR__ . '/../../include/db_conn.php'; //database connection file 

//checking valid request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  sanitization inputs
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    try {
        // prepare sql statement for data insertion
        $sql = "INSERT INTO users (first_name, last_name, email, password)
                VALUES (:first_name, :last_name, :email, :password)";

        $stmt = $pdo->prepare($sql);

        // bind parameters
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name',  $last_name,  PDO::PARAM_STR);
        $stmt->bindParam(':email',      $email,      PDO::PARAM_STR);
        $stmt->bindParam(':password',   $password,   PDO::PARAM_STR);

        // EXEC_
        $stmt->execute();

        header("Location: ../../index.html");
        exit;
    } catch (PDOException $e) {
        //  Err_ handeling
        if ($e->getCode() == 23000) { // duplicate email
            echo  "Error: Email already registered.";
        } else {
            echo " Database error: " . htmlspecialchars($e->getMessage()); // sql shit happenning
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- adding bootstrap style file -->
    <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <!-- add regulr css -->
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <!-- header section -->
      <header class="p-2 bg-light shadow-sm">
    <div class="container d-flex align-items-center">
      <!-- Logo on the left -->
      <a href="#" class="logo">expTrack</a>
    </div>
  </header>

   <!-- card start -->
<section class="">
  <div class="px-4 py-3 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <!-- Left heading text -->
          <h1 class="my-5 display-3 fw-bold ls-tight">
            The best Tracker <br />
            <span class="text-primary">of your Day</span>
          </h1>
          <!-- paragraph left buttom -->
          <p style="color: hsl(217, 10%, 50.8%)">
           expTrack, is a university project for INTERNET TECHNOLOGIES course inorder to get
           a good mark on the project and the course, "this Project boosts up the over all grading for students".  
           the project works as an expenses tracker helps students to keep track of their daily expenses in addition 
           to new execlusive features.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="POST" action="">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="first_name" name="first_name" class="form-control" />
                      <label class="form-label" for="first_name">First name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="last_name" name="last_name" class="form-control" />
                      <label class="form-label" for="last_name">Last name</label>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control" />
                  <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control" />
                  <label class="form-label" for="password">Password</label>
                </div>

                <!-- Submit  -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                  Sign up
                </button>
                  <p>Already have an account? </p><a href="./login.php">Login here</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<!-- adding bootstrap js file -->
 <script src="../../bootstrap/bootstrap.bundle.js"></script>
</body>
</html>