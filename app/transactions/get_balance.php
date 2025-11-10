<?php
session_start(); //start sessions
require '../../include/db_conn.php'; //database connection file

$user_id = $_SESSION['user_id'] ?? null; // ini user id for upcomming processes

if (!$user_id) {
    echo json_encode(['status'=>'error','message'=>'User not logged in']);
    exit;
}

try {
    // fetch total income
    $incomeStmt = $pdo->prepare("
        SELECT COALESCE(SUM(amount), 0) AS total_income
        FROM transactions
        WHERE user_id = :user_id AND type = 'income'
    ");
    $incomeStmt->execute([':user_id' => $user_id]);
    $income = $incomeStmt->fetchColumn(); //exec

    // fetch total expenses
    $expenseStmt = $pdo->prepare("
        SELECT COALESCE(SUM(amount), 0) AS total_expense
        FROM transactions
        WHERE user_id = :user_id AND type = 'expense'
    ");
    $expenseStmt->execute([':user_id' => $user_id]);
    $expense = $expenseStmt->fetchColumn(); //exec

    // calculate balance
    $balance = $income - $expense;
    //passing row data
    echo json_encode([
        'status' => 'success',
        'income' => number_format($income, 2),
        'expense' => number_format($expense, 2),
        'balance' => number_format($balance, 2)
    ]);

} catch (PDOException $e) {
    echo json_encode(['status'=>'error','message'=>$e->getMessage()]); //some shit is happenning 
}

?>