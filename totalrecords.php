
<head>
  <script src="jquery-3.1.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="style.css">

  <title>Total Records</title>

  <?php 
  require_once("functions.php");
  session_start();
  if(!isset($_SESSION['login'])){
    header('location: login.php');
  }
  ?>
</head>


<body>
  <body>
    <table><td>
    <div class="vertical-menu">
      <a href="index.php">Home</a>
      <a href="allrecords.php">All Records</a>
      <a href="totalrecords.php" class="active">Total Records</a>
      <a href="mvmt.php">Volunteer Movement</a>
      <a href="logout.php">Log out</a>
    </div></td>


    <td>

    <h1>Total Records</h1>
    <table>
      <tr><th>Student ID</th>
      <th>Class</th>
      <th>Number</th>
      <th>Name</th>
      <th>Service Hours</th></tr>
      <?php
      require_once("functions.php");
      $stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid");
      $stmt->execute();
      $stmt->bind_result($sid, $class, $no, $ename, $hours);
      while($stmt->fetch()){
        echo "<tr><td>".$sid."</td><td>".$class."</td><td>".$no."</td><td>".$ename."</td><td>".$hours."</td></tr>";
      }
      ?>

      <button id="exporttotal" class="export">Export</button>
    </table></td>



  <script src="script.js"></script>

</body>
