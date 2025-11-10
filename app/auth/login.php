<?php
//database connection dir and activates session 
require_once __DIR__ . '/../../include/db_conn.php';
session_start();

// check valid resuest
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  sanitization input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    //on submission action
    if (!empty($email) && !empty($password)) {
        try {
            // prepare sql to fetch user by email and verify
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                      // password matche
            if ($user && password_verify($password, $user['password'])) {
                // store the user id and first name in session 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'];
                // success login redirection
                header("Location: ../dashboard.php");
                exit();
            } else { // invalid credit handle 
                echo " Invalid email or password!";
            }
        } catch (PDOException $e) { // error hadling PODE
            echo " Database error: " . htmlspecialchars($e->getMessage());
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- adding bootstrap style file -->
    <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <!-- add regular css -->
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
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
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
            <div class="card-body py-7 px-md-4 ">
              <!-- login action form -->
              <form method="POST" action="">
                <div class="row">
                  <div class="col-md-6 mb-4">
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
                  <p>New to <span class=".text-primary-emphasis">expTrack</span>? try <a href="./register.php">Register</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- adding bootstrap javascript file -->
 <script src="../../bootstrap/bootstrap.bundle.js"></script>
</body>
</html>