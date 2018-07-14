
<head>
  <script src="jquery-3.1.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="style.css">

  <title>All Records</title>

  <?php 
  require_once("functions.php");
  session_start();
  if(!isset($_SESSION['login'])){
    header('location: login.php');
  }
  ?>
</head>


<body>
 
    <table><td>
    <div class="vertical-menu">
      <a href="index.php">Home</a>
      <a href="allrecords.php" class="active">All Records</a>
      <a href="totalrecords.php">Total Records</a>
      <a href="mvmt.php">Volunteer Movement</a>
      <a href="logout.php">Log out</a>
    </div></td>


    <td>

    <h1>All Records</h1>
    <table>
      <tr><th>Student ID</th>
      <th>Class</th>
      <th>Number</th>
      <th>Name</th>
      <th>Applicant</th>
      <th>Service Hours</th>
      <th>Clear</th></tr>
      <?php
      require_once("functions.php");
      $stmt=$db->prepare("SELECT rid, namelist.sid, class, no, ename, applicant, hours FROM namelist, record WHERE namelist.sid=record.sid ORDER BY rid DESC");
      $stmt->execute();
      $stmt->bind_result($rid, $sid, $class, $no, $ename,$applicant, $hours);
      while($stmt->fetch()){
        echo "<tr><td>".$sid."</td><td>".$class."</td><td>".$no."</td><td>".$ename."</td><td>".$applicant."</td><td>".$hours."</td><td><button value='".$rid."' class='clear' name='clear'>Clear</button></td></tr>";
      }
      ?>

      <button id="exportall" class="export" >Export</button>
    </table></td>



  <script src="script.js"></script>

</body>
