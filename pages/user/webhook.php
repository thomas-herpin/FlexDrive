<?php
require_once '../config.php';

// Set your Merchant Server Key
$server_key = 'SB-Mid-server-YOUR_SERVER_KEY';

// Get notification JSON from Midtrans
$notification_body = file_get_contents('php://input');
$notification = json_decode($notification_body, true);

// Extract order_id and payment status
$order_id = $notification['order_id'];
$transaction_status = $notification['transaction_status'];
$fraud_status = $notification['fraud_status'];

// Extract the actual order ID from our format (FLEXDRIVE-{id_pesan}-{timestamp})
$parts = explode('-', $order_id);
$id_pesan = $parts[1];

// Verify signature
$signature_key = hash('sha512', $notification['order_id'] . $notification['status_code'] . $notification['gross_amount'] . $server_key);

if ($signature_key != $notification['signature_key']) {
    exit("Signature verification failed");
}

// Handle different transaction status
if ($transaction_status == 'capture') {
    if ($fraud_status == 'challenge') {
        // Payment status challenged, update database accordingly
        $status = 'challenge';
    } else if ($fraud_status == 'accept') {
        // Payment successful and accepted
        $status = 'success';
    }
} else if ($transaction_status == 'settlement') {
    // Payment successful
    $status = 'success';
} else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
    // Payment failed or cancelled
    $status = 'failure';
} else if ($transaction_status == 'pending') {
    // Payment pending
    $status = 'pending';
}

// Update database with new payment status
$update_query = "UPDATE pemesanan SET status_pembayaran = '$status' WHERE id_pesan = $id_pesan";
mysqli_query($conn, $update_query);

// Return 200 OK
header('HTTP/1.1 200 OK');
?>
