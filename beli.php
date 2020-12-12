<?php
session_start();

// mendapatkan id_produk dari url
$id_produk = $_GET['id'];


//jika produk itu sudah ada di keranjanag makan produk itu ditambah 1
if(isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
} else {

//    selain itu (produk belum ada di keranjang),maka itu dianggap dibeli 1
     $_SESSION['keranjang'][$id_produk] = 1;
 
}

//echo"<pre>";
//print_r($_SESSION);
//echo"</pre>";

//hubungkan ke keranjang.php

echo "<script>alert('Produk Telah Masuk Ke Keranjang Belanja');</script>";
    
echo "<script>location='keranjang.php';</script>";

?>








