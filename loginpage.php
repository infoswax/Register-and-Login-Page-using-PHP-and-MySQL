<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.btn {
  border: none;
  color: white;
  padding: 14px 28px;
  font-size: 24px;
  cursor: pointer;
  border-radius: 50%;
}

.success {background-color: #04AA6D;} /* Green */
.success:hover {background-color: #46a049;}

</style>
</head>
<body>
  <div align="center">
    <br><br><br><br>
    <h1>Welcome </h1><br>
  <a href="Logout.php" class="btn success">Logout</a>
</div>
</body>
</html>
