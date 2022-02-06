<?php
session_start();
if (isset($_POST['submit'])) {

  $title = $_POST['submit'];

  include 'dbh.php';
  $im = "SELECT * FROM movies WHERE name = '$title'" ;

  $records = mysqli_query($conn,$im);

  echo"<!DOCTYPE html>";
  echo"<html lang='en' dir='ltr'>";
    echo"<head>";
      echo"<meta charset='utf-8'>";
      echo"<title>".$title."</title>";
      echo"<link rel='stylesheet' href='movie.css'>";
      echo"<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>";
    echo"</head>";
    echo"<body>";

        echo"<div class='jumbotron-fluid'>";
        echo"<div class='container'>";
        while($result = mysqli_fetch_assoc($records)){
            $mname = $result['name'];
            $person = $_SESSION['id'];
            $movieid = $result['mid'];
            $current = $result['viewers'];
            $newcount = $current + 1;
            $newsql = "UPDATE movies SET viewers = '$newcount' WHERE name='$mname' ";
            $nsql = "UPDATE user1 SET mid = '$movieid'";
            $updatecount = mysqli_query($conn,$newsql);
            $updatecount = mysqli_query($conn,$nsql);

            $url ="video-uploads/".$result['videopath'];

            echo"<br>";
            echo"<a href='homepage.php' style='font-size: 20px;color:orange;border:1px solid orange;border-radius:5px;padding:10px;text-decoration:none;'>Back to Home </a>";
          echo "<br><br><h4 style='display: inline;'><br>Movie Name : </h43><h3 style='display: inline;'>".ucwords($result['name'])."</h3>";
          echo"<br><h4 style='display: inline;' >Genre : </h4><h3 style='display: inline;'>".ucwords($result['genre'])."</h3>";
          echo"<br><h4 style='display: inline;' >release year : </h4><h3 style='display: inline;'>".$result['rdate']."</h3>";
          echo"<br><h4 style='display: inline;' >description : </h4><h3 style='display: inline;'>".ucfirst($result['decription'])."</h3>";
          echo"<br><h4 style='display: inline;' >runtime : </h4><h3 style='display: inline;'>".$result['runtime']." mins </h3>";
          echo"<br><h4 style='display: inline;' >views : </h4><h3 style='display: inline;'>".$result['viewers']."</h3>";

          echo"<br><br><br>";
          echo"<div class='embed-responsive embed-responsive-16by9'>";   
          echo '<video controls="controls" class="embed-responsive-item">
          <source src="'.$url.'" type="video/mp4"> 
          Your browser does not support the HTML5 Video element.
          </video>
          '; 
          echo"</div>";

        }
        echo"</div>";
        echo"</div>";

    echo"</body>";


  echo"</html>";


}
?>
