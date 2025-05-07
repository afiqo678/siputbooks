<?php require_once('Connections/siputbooks.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }
    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}

$searchId = "";
$showResults = false;
$totalRows_Recordset1 = 0;

// Guna POST dan bukan GET
if (isset($_POST['id']) && $_POST['id'] != "") {
  $searchId = $_POST['id'];
  $showResults = true;

  mysql_select_db($database_siputbooks, $siputbooks);
  $query_Recordset1 = sprintf("SELECT * FROM buku WHERE Namabuku = %s", GetSQLValueString($searchId, "text"));
  $Recordset1 = mysql_query($query_Recordset1, $siputbooks) or die(mysql_error());
  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($Recordset1);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Carian Pelanggan & Buku - Siput Books</title>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h1, h3 {
      text-align: center;
      color: #78AAD4;
      margin-top: 30px;
    }
    h3.success {
      color: #6EFF5E;
    }
    h3.error {
      color: #FF0004;
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
      text-align: left;
    }
    td.center {
      text-align: center;
    }
    input[type="text"] {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      padding: 8px 16px;
      background-color: #78AAD4;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }
    input[type="submit"]:hover {
      background-color: #5b94bd;
    }
  </style>
</head>
<body>
<h1>Carian Pelanggan & Buku</h1>

<form method="POST" name="form">
  <table width="423">
    <tr>
      <td width="138"><strong>NAMA BUKU</strong></td>
      <td width="318"><input type="text" name="id" id="id" placeholder=""></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="submit" id="submit" value="Submit"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form">
</form>

<?php if ($showResults && $totalRows_Recordset1 > 0) { ?>
  <h3 class="success">Keputusan Carian</h3>
  <table width="760">
    <tr>
      <td>
        <table width="1028">
          <tr>
            <td width="250" class="center"><strong>ID</strong></td>
            <td width="250" class="center"><strong>Nama Author</strong></td>
            <td width="250" class="center"><strong>Nama Buku</strong></td>
            <td width="250" class="center"><strong>Harga (RM)</strong></td>
          </tr>
          <tr>
            <td><?php echo $row_Recordset1['Id']; ?></td>
            <td><?php echo $row_Recordset1['Penulis']; ?></td>
            <td><?php echo $row_Recordset1['Namabuku']; ?></td>
            <td><?php echo $row_Recordset1['Harga']; ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php } elseif ($showResults) { ?>
  <h3 class="error">Tiada Keputusan</h3>
<?php } ?>
</body>
</html>

<?php
if (isset($Recordset1)) {
  mysql_free_result($Recordset1);
}
?>
