<?php
session_start(); //sesstion start 
// block unauth users <simple session check>
if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.html");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>expTrack Dashboard</title>
  <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../css/all.css">
</head>
<body class="bg-light">

  <!-- nav -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand fw-bold text-primary" href="./dashboard.php">expTrack</a>
    <div class="ms-auto">
      <span class="navbar-text">Welcome - <?php echo $_SESSION['user_name'];?> </span>
      
       <a href="./profile.php"><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></a>
       <a href="./auth/logout.php" class="btn btn-outline-secondary btn-sm ms-2"><i class="fa fa-sign-out" aria-hidden="true"></i>
Logout</a>
    </div>
  </nav>
<!-- get tranx success php --> 
<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
  <div class="alert alert-success alert-dismissible fade show text-center mx-3 mt-3 shadow-sm" role="alert">
     Transaction added successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

  <!-- Overview Cards -->
  <div class="container d-flex justify-content-center flex-wrap gap-4 mt-5" style="min-height: 45vh;">
    <!-- Balance Card -->
   <div class="card shadow-sm text-center" style="width: 22rem;">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3 text-dark">Current Balance</h5>
    <h2 id="balanceValue" class="text-success fw-semibold">$0.00</h2>
    <!-- set 0 for dynamic don't worry -->
    <p id="incomeExpenseText" class="text-secondary mb-3 mt-2">
      Income: $0 | Expenses: $0 
    </p>
    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addBalanceModal">
      Add Balance
    </button>
  </div>
</div>


<!-- add balamce -->
<div class="modal fade" id="addBalanceModal" tabindex="-1" aria-labelledby="addBalanceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="addBalanceModalLabel">Add Balance</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- add balance form -->
        <form id="balanceForm" method="POST" action="./transactions/transactions.php">
          <!-- hidden input to pass the type without user interaction -->
          <input type="hidden" name="type" value="income">

          <!-- amount -->
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
          </div>

          <!-- method -->
          <div class="mb-3">
            <label for="method" class="form-label">Method</label>
            <select class="form-select" id="method" name="method" required>
              <option value="">Select type</option>
              <option value="Cash">Cash</option>
              <option value="Bank">Bank</option>
            </select>
          </div>

          <!-- description -->
          <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Write a short note..."></textarea>
          </div>

          <!-- save tranx btn -->
          <div class="text-end">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- expenses modal +view -->
    <div class="card shadow-sm text-center" style="width: 22rem;">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3 text-dark">Total Expenses</h5>
    <h2 id="totalExpenses" class="text-danger fw-semibold">$0.00</h2>
    <p id="recentExpenses" class="text-secondary mb-3 mt-2">
      Recent: none
    </p>
    <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
      Add Expense
    </button>
  </div>
</div>

<!-- add expense  -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- tranx form -->
        <form method="POST" action="./transactions/transactions.php">
          <!-- hidden input to pass trnx type -->
          <input type="hidden" name="type" value="expense">

          <!-- amount -->
          <div class="mb-3">
            <label for="expenseAmount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="expenseAmount" name="amount" placeholder="Enter expense amount" required>
          </div>

          <!-- method -->
          <div class="mb-3">
            <label for="expenseMethod" class="form-label">Method</label>
            <select class="form-select" id="expenseMethod" name="method" required>
              <option value="">Select method</option>
              <option value="Cash">Cash</option>
              <option value="Bank">Bank</option>
            </select>
          </div>

          <!-- category -->
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category">
              <option value="">Select category</option>
              <option value="Food">Food</option>
              <option value="Transport">Transport</option>
              <option value="Utilities">Utilities</option>
              <option value="Entertainment">Entertainment</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <!-- description -->
          <div class="mb-3">
            <label for="expenseDescription" class="form-label">Description (optional)</label>
            <textarea class="form-control" id="expenseDescription" name="description" rows="2" placeholder="Write a short note..."></textarea>
          </div>

          <!-- save btn -->
          <div class="text-end">
            <button type="submit" class="btn btn-danger">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  // fetch tranx 
  if (data.recent_expense) {
  document.getElementById("recentExpenses").textContent =
    `Recent: ${data.recent_expense.description || 'N/A'} - $${data.recent_expense.amount}`;
}
</script>
<!-- add bootstrap js file -->
<script src="../js/dashCard.js"></script>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- separating  -->
  <div class="container my-5">
    <hr class="border border-secondary opacity-50">
  </div>

  <!-- tranx table -->
  <div class="container mb-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white fw-bold">
        Recent Transactions
      </div>
      <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
        <table class="table table-hover mb-0 align-middle">
          <thead class="table-light sticky-top">
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Type</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Example static transactions array (replace with dynamic DB data)
            $transactions = [
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Scholarship','Income','+$500'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-17','Transport','Expense','-$30'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-16','Books','Expense','-$45'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-15','Part-time Job','Income','+$250'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
              ['2025-10-18','Lunch','Expense','-$15'],
            ];

            foreach($transactions as $txn){
              $type = $txn[2];
              $badgeClass = $type === 'Income' ? 'bg-success' : 'bg-danger';
              echo "<tr>
                      <td>{$txn[0]}</td>
                      <td>{$txn[1]}</td>
                      <td><span class='badge $badgeClass'>$type</span></td>
                      <td>{$txn[3]}</td>
                      <td><button class='btn btn-sm btn-outline-danger'>Delete</button></td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="../bootstrap/bootstrap.bundle.js"></script>
  <!-- footer -->
<footer class="bg-primary text-white pt-5">
  <div class="container">
    <div class="row gy-4">

      <!-- about -->
      <div class="col-lg-4 col-md-6">
        <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
          <span class="fs-4 fw-bold">expTrack</span>
        </a>
        <div>
          <p class="mb-1">Karary, Wadi St</p>
          <p class="mb-1">Khartoum, Sudan 11111</p>
          <p class="mb-1"><strong>Phone:</strong> +249 126 0872 24</p>
          <p><strong>Email:</strong> info@exptrack.com</p>
        </div>
      </div>

      <!-- sitemap Links -->
      <div class="col-lg-2 col-md-3">
        <h5 class="fw-bold">Useful Links</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Home</a></li>
          <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
          <li><a href="#" class="text-white text-decoration-none">Services</a></li>
          <li><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
        </ul>
      </div>

      <!-- services -->
      <div class="col-lg-2 col-md-3">
        <h5 class="fw-bold">Our Services</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Cyber Security Counseling</a></li>
          <li><a href="#" class="text-white text-decoration-none">Web Development</a></li>
          <li><a href="#" class="text-white text-decoration-none">Cloud Infrastructure</a></li>
          <li><a href="#" class="text-white text-decoration-none">Networking</a></li>
        </ul>
      </div>

      <!-- social -->
      <div class="col-lg-4 col-md-12">
        <h5 class="fw-bold">Follow Us</h5>
        <p>Let's connect, follow us on social media and stay up to date with our services.</p>
        <div class="d-flex gap-2">
          <a href="#" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

    </div>

    <!-- copyright -->
    <div class="text-center mt-4 border-top border-white pt-3">
      <p class="mb-0">© <strong>expTrack</strong>. All Rights Reserved.</p>
    </div>
  </div>

<!-- scroller -->
  <a href="#" class="position-fixed bottom-0 end-0 m-3 btn btn-light rounded-circle shadow" style="width: 45px; height: 45px;" id="scroll-top">
<i class="fa fa-arrow-up"></i>
  </a>
</footer>


<script>
  const scrollTopBtn = document.getElementById('scroll-top');
  scrollTopBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>

<script src="../js/alert_control.js"></script>
<script src="../js/fetch_balance_ajax.js"></script>
</body>

</html>