<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BGS | Nota</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<!--    Navbar-->
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
        <!--                    jika sudah login (ada session pelanggan) -->
                   <?php if(isset($_SESSION['pelanggan'])): ?>
                   <li><a href="logout.php" onclick="return confirm ('Anda Yakin Ingin Logout?')">Logout</a></li>
        <!--                  jika belum login (tidak ada session pelanggan)-->
                   
                    <?php else: ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif ?>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
        </nav>
        
<section class="konten">
    <div class="container">
        <h2>Nota Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
         ON pembelian.id_pelanggan=pelanggan.id_pelanggan
         WHERE pembelian.id_pembelian='$_GET[id]'"); 
$detail = $ambil->fetch_assoc();
?>


<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong> <br>
        Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
	    Total : Rp.  <?php echo number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong>Nama  : <?php echo $detail['nama_pelanggan']; ?></strong><p>
	           Telepon  :  <?php echo $detail['telepon_pelanggan']; ?><br>
	              Email : <?php echo $detail['email_pelanggan']; ?>
    </div>
    <div class="col-md-4"></div>
    <h3>Pengiriman</h3>
    <strong>Kab. /Kota : <?php echo $detail['nama_kota']; ?></strong><br>
    Ongkir : <?php echo $detail['tarif']; ?> <br>
    Alamat : <?php echo $detail['alamat_pengiriman']; ?>
</div>

<table class="table table-bordered text-center">
    <thead>
    <tr>
    <th class="text-center"> No. </th>
    <th class="text-center"> Nama Produk </th>
    <th class="text-center"> Harga Produk </th>
    <th class="text-center"> Berat Produk </th>
    <th class="text-center"> Jumlah </th>
    <th class="text-center"> Subharga</th>
    <th class="text-center"> Subberat</th>
</tr>
</thead>
<tbody>
<?php $nomor = 1; ?>
       <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'"); ?>
       <?php while ($pecah = $ambil->fetch_assoc()) { ?>
<tr>
	<td><?php echo $nomor; ?></td>
	<td><?php echo $pecah['nama']; ?></td>
	<td><?php echo number_format($pecah['harga']); ?></td>
	<td><?php echo $pecah['berat']; ?> Gr.</td>
	<td><?php echo $pecah['jumlah']; ?></td>
	<td><?php echo number_format($pecah['subharga']); ?></td>
	<td><?php echo $pecah['subberat']; ?> Gr.</td>
</tr>
<?php $nomor++; ?>
<?php } ?>
</tbody>
</table>
   <div class="row">
       <div class="col-md-6 alert alert-success">
     <p>Silahkan Lakukan Pembayaran Rp.  <?php echo number_format($detail['total_pembelian']); ?> Ke <br>
     <strong>BANK MANDIRI 156-00-1283990-0 AN FARIZAL HENDRA PUTRA KUSUMA</strong>
      </p>
       </div>
   </div>
    </div>
</section>        
   
</body>
</html>