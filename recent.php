<head>
  <script src="jquery-3.1.1.min.js"></script>
  <script src="script.js"></script>
  <?php
  require_once('functions.php');
  ?>
</head>
<table>
  <th>applicant</th>
  <th>date</th>
  <th>hours</th>
  <th>sid</th>
  <th>class</th>
  <th>ename</th>
  <th>clear</th>

  <?php
  $stmt=$db->prepare("SELECT rid, added_on, applicant, day, hours, record.sid, class, ename FROM namelist, record WHERE record.sid = namelist.sid AND applicant = (SELECT applicant FROM record ORDER BY added_on DESC LIMIT 1) AND day = (SELECT MAX(day) FROM record)");
  $stmt->execute();
  $stmt->bind_result($rid,$added_on,$applicant,$day,$hours,$sid,$class,$ename);

  while($stmt->fetch()){
    echo "<tr><td>".$applicant."</td><td>".$day."</td><td>".$hours."</td><td>".$sid."</td><td>".$class."</td><td>".$ename."</td><td><button value=\"".$rid."\" class='clear' name='clear'>Clear</button>";
  }
  ?>
</table>
