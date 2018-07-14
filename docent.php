<head>
  <?php
  require_once("functions.php");

  $stmt = $db->prepare("SELECT record.sid, class, no, ename, shours FROM (SELECT sid, SUM(hours) as shours FROM record GROUP BY sid) record, namelist WHERE record.sid=namelist.sid AND record.sid=(SELECT sid FROM record ORDER BY rid DESC LIMIT 1) ");
  $stmt->execute();
  $stmt->bind_result($sid, $class, $no, $ename, $hours);
  $stmt->fetch();
  ?>
</head>

<body>
  <table>
    <tr><td>Student ID</td><td><?php echo $sid; ?></td></tr>
    <tr><td>Class</td><td><?php echo $class; ?></td></tr>
    <tr><td>Class Number</td><td><?php echo $no; ?></td></tr>
    <tr><td>Name</td><td><?php echo $ename; ?></td></tr>
    <tr><td>Hours</td><td><?php echo $hours; ?></td></tr>
  </table>
</body>
