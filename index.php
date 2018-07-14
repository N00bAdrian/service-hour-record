<!DOCTYPE html>
<html>
<head>
<?php
require_once("functions.php");
session_start();
if(!isset($_SESSION['login'])){
  header('location: login.php');
}
?>

<!-- <script src="jquery-3.1.1.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script> -->

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="style.css">


<title>Input Service Hour</title>
</head>

<body>
  <table><td>
  <div class="vertical-menu">
    <a href="index.php" class="active">Home</a>
    <a href="allrecords.php">All Records</a>
    <a href="totalrecords.php">Total Records</a>
    <a href="mvmt.php">Volunteer Movement</a>
    <a href="logout.php">Log out</a>
  </div></td>


  <td><div class="overall">
    <h1>Input Service Hour</h1>
    <div class="record" id="record">
      <table>
        <td>
          <form id="input" method="POST" action="submit.php">
            <fieldset>
              <table>
                <tr><td><label>Activity/Applicant: </label></td>
                  <td><input type="text" name="applicant" id="applicant" class="required" /></td></tr>
                  <tr><td><label>Date: </label></td>
                    <td><input type="date" name="date" id="date"  class="required"/></td></tr>
                <tr><td><label>Number of Hours: </label></td>
                  <td><input type="text" name="hours" id="hours" class="required"/></td></tr>
                <tr><td><label>Docent: </label></td>
                  <td><input type="text" name="docent" id="docent" value="" class="required"/></td></tr>
                <tr><td><button value="submit" name="submit" id="submit">Submit</button></td><td></td></tr>
            </table>
            </fieldset>
          </form>
        </td>
        <td>
          <iframe src="docent.php" class="person" id="person" frameborder="0" width="500px"></iframe>
        </td>
      </table>
    </div>

    <div class="current" id="current">
      <iframe class="recent" id="recent" src="recent.php" frameborder="0" width="500" height="500"></iframe>
    </div>
  </div></td>
  <script src="script.js"></script>
</body>
</html>
