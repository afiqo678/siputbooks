<?php

$hostname = "localhost"; 
$username = "root";      
$password = "";         
$database = "siputbooks";

$connection = mysqli_connect($hostname, $username, $password, $database);


if (!$connection) {
  die("Gagal sambung ke pangkalan data: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "form") {
  $Noic = mysqli_real_escape_string($connection, $_POST['Noic']);
  $Nama = mysqli_real_escape_string($connection, $_POST['Nama']);
  $Notel = mysqli_real_escape_string($connection, $_POST['Notel']);
  $Jantina = mysqli_real_escape_string($connection, $_POST['jantina']);
  $Tarikhpinjam = mysqli_real_escape_string($connection, $_POST['date']);
  $Tarikhpulang = mysqli_real_escape_string($connection, $_POST['date2']);

  $sql = "INSERT INTO pelanggan (Nama, Jantina, Tarikhpinjam, Tarikhpulang, Notel, Noic) 
          VALUES ('$Nama', '$Jantina', '$Tarikhpinjam', '$Tarikhpulang', '$Notel', '$Noic')";

  if (mysqli_query($connection, $sql)) {
    header("Location: index.php");
    exit();
  } else {
    echo "Ralat: " . mysqli_error($connection);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daftar Pelanggan - Siput Books</title>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
	text-align: center;
	color: #78AAD4;
	margin-top: 40px;
    }

    form {
      background-color: #ffffff;
      border: 2px solid #63B0C0;
      border-radius: 10px;
      width: 400px;
      margin: 30px auto;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 10px;
      vertical-align: top;
    }

    input[type="text"],
    input[type="tel"],
    input[type="date"] {
      width: 95%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    input[type="submit"],
    input[type="reset"] {
      padding: 10px 20px;
      border: none;
      background-color: #63B0C0;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      margin-right: 10px;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
      background-color: #4d94a1;
    }
  </style>
</head>

<body>
<img src="siput.png" width="325.5" height="192" alt=""/>
	
<h1>Daftar Pelanggan</h1>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table>
      <tr>
        <td>No IC</td>
        <td><input type="text" name="Noic" required></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td><input type="text" name="Nama" required></td>
      </tr>
      <tr>
        <td>No Tel</td>
        <td><input type="tel" name="Notel" required></td>
      </tr>
      <tr>
        <td>Jantina</td>
        <td>
          <label><input type="radio" name="jantina" value="Lelaki" required> Lelaki</label><br>
          <label><input type="radio" name="jantina" value="Perempuan"> Perempuan</label>
        </td>
      </tr>
      <tr>
        <td>Tarikh Pinjam</td>
        <td><input type="date" name="date" required></td>
      </tr>
      <tr>
        <td>Tarikh Pulang</td>
        <td><input type="date" name="date2" required></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" name="submit" value="Hantar">
          <input type="reset" value="Reset">
        </td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form">
</form>
</body>
</html>
