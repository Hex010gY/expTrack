then(data => {
  if (data.status === 'success') {
    // Close modal and update UI
    const modal = bootstrap.Modal.getInstance(document.getElementById('addBalanceModal'));
    modal.hide();
    fetchBalance(); // refresh the numbers
  }
})
document.addEventListener("DOMContentLoaded", () => {
  fetch("../transactions/get_balance.php")
    .then(response => response.json())
    .then(data => {
      if (data.status === "success") {
        // Update balance card
        document.getElementById("balanceValue").textContent = `$${data.balance}`;
        document.getElementById("incomeExpenseText").textContent =
          `Income: $${data.income} | Expenses: $${data.expense}`;

        // 🆕 Update expenses card
        document.getElementById("totalExpenses").textContent = `$${data.expense}`;
        document.getElementById("recentExpenses").textContent =
          `Recent total: $${data.expense}`;
      } else {
        console.error("Error:", data.message);
      }
    })
    .catch(error => console.error("Error fetching balance:", error));
});