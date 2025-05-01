<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit();


}

if (isset($_POST['submit_payment'])) {
    $id_pesan = $_POST['id_pesan'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $metode_pembayaran = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'transfer';
    
    // Handle file upload
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        $filename = $_FILES['bukti_pembayaran']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Check if file type is allowed
        if (in_array(strtolower($ext), $allowed)) {
            // Check file size (max 2MB)
            if ($_FILES['bukti_pembayaran']['size'] <= 2097152) {
                $new_filename = 'payment_' . $id_pesan . '_' . time() . '.' . $ext;
                $upload_path = '../../uploads/payments/' . $new_filename;
                
                // Create directory if it doesn't exist
                if (!file_exists('../../uploads/payments/')) {
                    mkdir('../../uploads/payments/', 0777, true);
                }
                
                // Move uploaded file
                if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $upload_path)) {
                    // Insert into pembayaran table
                    $status = 'menunggu_konfirmasi';
                    $id_usernya = $_SESSION['user_id'];
                    $insert_query = "INSERT INTO pembayaran (
                                    id_pesan,
                                    id_user, 
                                    jumlah_bayar, 
                                    metode_pembayaran,
                                    bukti_pembayaran, 
                                    status_pembayaran, 
                                    tanggal_pembayaran
                                ) VALUES (
                                    $id_pesan,
                                    $id_usernya,
                                    $jumlah_bayar,
                                    '$metode_pembayaran',
                                    '$new_filename',
                                    '$status',
                                    NOW()
                                )";
                    
                    if (mysqli_query($conn, $insert_query)) {
                        // Update pemesanan status
                        mysqli_query($conn, "UPDATE pembayaran SET status_pembayaran = 'menunggu_konfirmasi' WHERE id_pesan = $id_pesan");
                        
                        // Success
                        header("Location: pembayaran-sukses.php?id_pesan=$id_pesan");
                        exit();
                    } else {
                        echo "Error updating database: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "File too large. Max 2MB allowed.";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and PDF allowed.";
        }
    } else {
        echo "Error uploading file: " . $_FILES['bukti_pembayaran']['error'];
    }
}
?>
