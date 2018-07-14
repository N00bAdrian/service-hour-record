<head>
    <script src="jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1>Bronze</h1>

  <button id="exportbronze" class="export" name="exportbronze">Export</button>
  <table>
    <tr><th>Student ID</th>
    <th>Class</th>
    <th>Number</th>
    <th>Name</th>
    <th>Service Hours</th></tr>
    <?php
    require_once("functions.php");
    $stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid AND thours >=50 AND thours < 100");
    $stmt->execute();
    $stmt->bind_result($sid, $class, $no, $ename, $hours);
    while($stmt->fetch()){
      echo "<tr><td>".$sid."</td><td>".$class."</td><td>".$no."</td><td>".$ename."</td><td>".$hours."</td></tr>";
    }
    ?>
  </table>

  <script src="script.js"></script>
</body>