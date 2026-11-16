<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Tes Keranjang Belanja</title>
</head>
<body>
<h1>Barang Tersedia</h1>
<form action="carttest.php" method="post">
<table>
<tr><th>Barang</th><th>Jumlah</th></tr>
<tr><td>Apel</td><td><input type="text" name="apel" size="2"></td></tr>
<tr><td>Pisang</td><td><input type="text" name="pisang" size="2"></td></tr>
</table>
<input type="submit" value="Tambahkan ke Keranjang">
</form>
<br>

<?php
if (isset($_POST['apel']) && is_numeric($_POST['apel'])) {
    if (!isset($_SESSION['keranjang']['apel'])) {
        $_SESSION['keranjang']['apel'] = 0;
    }
    $_SESSION['keranjang']['apel'] += (int)$_POST['apel'];
}

if (isset($_POST['pisang']) && is_numeric($_POST['pisang'])) {
    if (!isset($_SESSION['keranjang']['pisang'])) {
        $_SESSION['keranjang']['pisang'] = 0;
    }
    $_SESSION['keranjang']['pisang'] += (int)$_POST['pisang'];
}

if (isset($_POST['kurangi_barang'])) {
    $barang = str_replace("Kurangi:", "", $_POST['kurangi_barang']);
    if (isset($_SESSION['keranjang'][$barang])) {
        $_SESSION['keranjang'][$barang]--;
        if ($_SESSION['keranjang'][$barang] <= 0) {
            unset($_SESSION['keranjang'][$barang]);
        }
    }
}
?>

<fieldset style="width:350px">
<legend>Keranjang Belanja</legend>
<?php
if (empty($_SESSION['keranjang'])) {
    echo "Keranjang belanja masih kosong\n";
} else {
    echo "<form action=\"carttest.php\" method=\"post\">\n";
    echo "<table>\n";
    echo "<tr><th>Barang</th><th>Jumlah</th><th>Aksi</th></tr>\n";
    foreach ($_SESSION['keranjang'] as $nama => $jumlah) {
        echo "<tr><td>$nama</td><td>$jumlah</td>";
        echo "<td><input type=\"submit\" name=\"kurangi_barang\" value=\"Kurangi:$nama\"></td></tr>\n";
    }
    echo "</table>\n";
    echo "</form>\n";
}
?>
</fieldset>
</body>
</html>