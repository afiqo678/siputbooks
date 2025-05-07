<?php
// Sambungan ke database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "siputbooks";

$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
  die("Gagal sambung ke database: " . mysqli_connect_error());
}

// Proses borang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "form") {
  $Nosiri = mysqli_real_escape_string($connection, $_POST['Nosiri']);
  $Namabuku = mysqli_real_escape_string($connection, $_POST['Namabuku']);
  $Penulis = mysqli_real_escape_string($connection, $_POST['Penulis']);
  $Harga = mysqli_real_escape_string($connection, $_POST['Harga']);

  $sql = "INSERT INTO buku (Namabuku, Penulis, Harga, Nosiri) VALUES ('$Namabuku', '$Penulis', '$Harga', '$Nosiri')";

  if (mysqli_query($connection, $sql)) {
    header("Location: index.php");
    exit();
  } else {
    echo "Ralat: " . mysqli_error($connection);
  }
}

// Papar semua buku (jika perlu nanti)
$query = "SELECT * FROM buku ORDER BY Id ASC";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daftar Buku - Siput Books</title>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h1 {
      text-align: center;
      color: #78AAD4;
      margin-top: 30px;
    }
    table {
      border-collapse: collapse;
      margin: 0 auto;
      background-color: #fff;
      border: 2px solid #63B0C0;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    td {
      padding: 10px;
    }
    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"], input[type="reset"] {
      padding: 8px 16px;
      background-color: #78AAD4;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }
    input[type="submit"]:hover, input[type="reset"]:hover {
      background-color: #5b94bd;
    }
  </style>
</head>
<body>

<h1>Daftar Buku</h1>
<form method="POST" action="">
  <table width="450">
    <tr>
      <td width="120"><strong>No Siri</strong></td>
      <td><input type="text" name="Nosiri" required></td>
    </tr>
    <tr>
      <td><strong>Nama Buku</strong></td>
      <td><input type="text" name="Namabuku" required></td>
    </tr>
    <tr>
      <td><strong>Penulis</strong></td>
      <td><input type="text" name="Penulis" required></td>
    </tr>
    <tr>
      <td><strong>Harga (RM)</strong></td>
      <td><input type="number" name="Harga" step="0.01" required></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form">
</form>

</body>
</html>
