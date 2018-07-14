
<head>
  <script src="jquery-3.1.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="style.css">

  <title>Volunteer movement</title>

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
      <a href="allrecords.php">All Records</a>
      <a href="totalrecords.php">Total Records</a>
      <a href="mvmt.php" class="active">Volunteer Movement</a>
      <a href="logout.php">Log out</a>
    </div></td>


    <td>
    <h1>Volunteer Movement</h1>
    <h2>Total service hours: 
    <?php 
    $sql = $db->prepare("SELECT SUM(hours) FROM record");
    $sql->execute();
    $sql->bind_result($data);
    $sql->fetch();
    echo $data;
    ?></h2><br>

    <table><tr><td>
    <iframe src="bronze.php" id="mvmtbronze" class="mvmttable"></iframe>
    </td><td>
    <iframe src="silver.php" id="mvmtsilver" class="mvmttable"></iframe>
    </td><td>
    <iframe src="gold.php" id="mvmtgold" class="mvmttable"></iframe>
    </td></tr></table>


  </table>
  <script src="script.js"></script>

</body>
