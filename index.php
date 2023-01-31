<?php

if(isset($_COOKIE["ResultsMatches"])){
    $matches = json_decode($_COOKIE["ResultsMatches"], true);

} else {
    $matches = array(

        "MoroccoVsCroatia" => array ("Morocco" => 0 , "Croatia" => 0 , "Status" => false ),
        "CanadaVsBelgium" => array ("Canada" => 0 , "Belgium" => 0 , "Status" => false),
        "BelgiumVsMorocco" => array ("Belgium" => 0 , "Morocco" => 0 , "Status" => false),
        "CroatiaVsCanada" => array ("Croatia" => 0 , "Canada" => 0 , "Status" => false),
        "MoroccoVsCanada" => array ("Morocco" => 0 , "Canada" => 0 , "Status" => false),
        "CroatiaVsBelgium" => array ("Croatia" => 0 , "Belgium" => 0 , "Status" => false),
      
      ); 

}

// ==================-------------



if(isset($_COOKIE["ResultsTable"])){

    $resoltMatches = json_decode($_COOKIE["ResultsTable"], true);

} else {

    $resoltMatches = array (
        "Morocco" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
        "Croatia" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
        "Belgium" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
        "Canada" => array ("PTS." => 0 , "MP" => 0  ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
      );

}





if($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["match"])){

  $matches[$_POST["match"]][$_POST["KeyOne"]] = $_POST["ValueOne"];
  $matches[$_POST["match"]][$_POST["KeyTwo"]] = $_POST["ValueTwo"];
  $matches[$_POST["match"]]["Status"] = true;

  setcookie("ResultsMatches" ,json_encode($matches) , strtotime("+1 month"));



}



if($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["RESET"])){
    header("Refresh:0");

    $matches = array(

        "MoroccoVsCroatia" => array ("Morocco" => 0 , "Croatia" => 0 , "Status" => false),
        "CanadaVsBelgium" => array ("Canada" => 0 , "Belgium" => 0 , "Status" => false),
        "BelgiumVsMorocco" => array ("Belgium" => 0 , "Morocco" => 0 , "Status" => false),
        "CroatiaVsCanada" => array ("Croatia" => 0 , "Canada" => 0 , "Status" => false),
        "MoroccoVsCanada" => array ("Morocco" => 0 , "Canada" => 0 , "Status" => false),
        "CroatiaVsBelgium" => array ("Croatia" => 0 , "Belgium" => 0 , "Status" => false),

    );

        $resoltMatches = array (
            "Morocco" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
            "Croatia" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
            "Belgium" => array ("PTS." => 0 , "MP" => 0 ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
            "Canada" => array ("PTS." => 0 , "MP" => 0  ,"GF" => 0 , "GA" => 0 , "W" => 0 , "D" => 0 , "L" => 0 , "GD" => 0 ),
    );
          
    
setcookie("ResultsMatches" ,json_encode($matches) , strtotime("+1 month"));
setcookie("ResultsTable" ,json_encode($resoltMatches) , strtotime("+1 month"));

};






$columns = array_column($resoltMatches, 'PTS.');
array_multisort($columns, SORT_DESC, $resoltMatches);

      uasort($resoltMatches, function ($a, $b) {
          if ($a["PTS."] === $b["PTS."]) {
              if ($a["GD"] === $b["GD"]) {
                  if ($a["GF"] === $b["GF"]) {
                      return 0;
                  } else if ($a["GF"] < $b["GF"]) {
                      return 1;
                  } else if ($a["GF"] > $b["GF"]) {
                      return -1;
                  }
              } else if ($a["GD"] < $b["GD"]) {
                  return 1;
              } else if ($a["GD"] > $b["GD"]) {
                  return -1;
              }
          } else if ($a["PTS."] < $b["PTS."]) {
              return 1;
          } else if ($a["PTS."] > $b["PTS."]) {
              return -1;
          }
});















$datakeycantry = [];
$datavaluecantry = [];



if (isset($_POST["match"])) {

    
foreach ($matches[$_POST["match"]] as $matchname => $allcountries) {
 
    array_push($datakeycantry, $matchname);
    array_push($datavaluecantry, $allcountries);
    
      
}


if($datavaluecantry[0] < $datavaluecantry[1] ){
// ------------------
 $resoltMatches["$datakeycantry[0]"]["PTS."] += 0;
 $resoltMatches["$datakeycantry[1]"]["PTS."] += 3;
//  ------------------
 $resoltMatches["$datakeycantry[0]"]["MP"] += 1;
 $resoltMatches["$datakeycantry[1]"]["MP"] += 1;
//  -----------------------
 $resoltMatches["$datakeycantry[0]"]["W"] += 0;
 $resoltMatches["$datakeycantry[1]"]["W"] += 1;
//  --------------
 $resoltMatches["$datakeycantry[0]"]["L"] += 1;
 $resoltMatches["$datakeycantry[1]"]["L"] += 0;
//  -------------
$resoltMatches["$datakeycantry[0]"]["GF"] += $_POST["ValueOne"];
$resoltMatches["$datakeycantry[1]"]["GF"] += $_POST["ValueTwo"];
// ---------
$resoltMatches["$datakeycantry[0]"]["GA"] += $_POST["ValueTwo"];
$resoltMatches["$datakeycantry[1]"]["GA"] += $_POST["ValueOne"];
// ----------------
$resoltMatches["$datakeycantry[0]"]["GD"] += $_POST["ValueOne"] - $_POST["ValueTwo"];
$resoltMatches["$datakeycantry[1]"]["GD"] += $_POST["ValueTwo"] - $_POST["ValueOne"];

 


} elseif($datavaluecantry[0] > $datavaluecantry[1] ){


  $resoltMatches["$datakeycantry[0]"]["PTS."] += 3;
  $resoltMatches["$datakeycantry[1]"]["PTS."] += 0;
 //  ------------------
  $resoltMatches["$datakeycantry[0]"]["MP"] += 1;
  $resoltMatches["$datakeycantry[1]"]["MP"] += 1;
 //  -----------------------
  $resoltMatches["$datakeycantry[0]"]["W"] += 1;
  $resoltMatches["$datakeycantry[1]"]["W"] += 0;
 //  --------------
  $resoltMatches["$datakeycantry[0]"]["L"] += 0;
  $resoltMatches["$datakeycantry[1]"]["L"] += 1;
 //  -------------
 $resoltMatches["$datakeycantry[0]"]["GF"] += $_POST["ValueOne"];
 $resoltMatches["$datakeycantry[1]"]["GF"] += $_POST["ValueTwo"];
 // ---------
 $resoltMatches["$datakeycantry[0]"]["GA"] += $_POST["ValueTwo"];
 $resoltMatches["$datakeycantry[1]"]["GA"] += $_POST["ValueOne"];
 // ----------------
 $resoltMatches["$datakeycantry[0]"]["GD"] += $_POST["ValueOne"] - $_POST["ValueTwo"];
 $resoltMatches["$datakeycantry[1]"]["GD"] += $_POST["ValueTwo"] - $_POST["ValueOne"];


} else {
    $resoltMatches["$datakeycantry[0]"]["PTS."] += 1;
    $resoltMatches["$datakeycantry[1]"]["PTS."] += 1;
   //  ------------------
    $resoltMatches["$datakeycantry[0]"]["MP"] += 1;
    $resoltMatches["$datakeycantry[1]"]["MP"] += 1;
   //  -----------------------
    $resoltMatches["$datakeycantry[0]"]["W"] += 0;
    $resoltMatches["$datakeycantry[1]"]["W"] += 0;
   //  --------------
    $resoltMatches["$datakeycantry[0]"]["L"] += 0;
    $resoltMatches["$datakeycantry[1]"]["L"] += 0;
   //  -------------
   $resoltMatches["$datakeycantry[0]"]["GF"] += $_POST["ValueOne"];
   $resoltMatches["$datakeycantry[1]"]["GF"] += $_POST["ValueTwo"];
   // ---------
   $resoltMatches["$datakeycantry[0]"]["GA"] += $_POST["ValueTwo"];
   $resoltMatches["$datakeycantry[1]"]["GA"] += $_POST["ValueOne"];
   // ----------------
   $resoltMatches["$datakeycantry[0]"]["GD"] += $_POST["ValueOne"] - $_POST["ValueTwo"];
   $resoltMatches["$datakeycantry[1]"]["GD"] += $_POST["ValueTwo"] - $_POST["ValueOne"];

}
setcookie("ResultsTable" ,json_encode($resoltMatches) , strtotime("+1 month"));

};






?>  











<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Bootstrap demo</title>
	<link rel="stylesheet" href="style.css">
  </head>
  <body>
  <nav class="navbar" style="background:#8A1538">
  <div class="container-fluid">
    <a class="navbar-brand d-flex" href="#">
      <img src="img/logo.png" alt="Logo" width="100" height=">100" class="d-inline-block align-text-top">
      <h3 class="text-white mt-2">Qatar FiFa 2022 World Cup</h3>
    </a>
  </div>
</nav>

  

  <?php
    foreach ($matches as $key => $value) {
    $datakey = [];
    $datavalue = [];
    foreach ($value as $mkey => $mvalue) {

            array_push($datakey , $mkey);
            array_push($datavalue , $mvalue);
        } ;


        ?>
      
        <div class="container row text-white mt-4 mb-4 mx-auto" style="background:#8A1538">

        <div class="col ">
            <h2><?php echo $datakey[0]?></h2>
        </div>

        <form class="col d-flex" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input <?php if($value["Status"] === true){echo "readonly";}?> class="rounded p-2" min="0" name="ValueOne" value="<?php echo $datavalue[0] ?>" type="number" style="width:50px; height: 50px ;  margin-top: 13px; margin-left: 36px;">
            <input <?php if($value["Status"] === true){echo "readonly";}?> class="rounded p-2" min="0" name="KeyOne" value="<?php echo $datakey[0] ?>" type="hidden">
            <div style="margin:0 20px ; ">
                <p class="mt-2 mb-1 fw-bold text-center">VS</p>
                <!-- input hidden to know name of the match -->
                <input class="bg-success text-white" name="match" type="hidden" value="<?php echo $key?>">
                <input  <?php if($value["Status"] === true){echo "disabled";}?> class="btn btn-warning text-black" value="add" type="submit">
            </div>
            <input <?php if($value["Status"] === true){echo "readonly";}?> class="rounded p-2" min="0" name="ValueTwo" value="<?php echo $datavalue[1] ?>" type="number" style="width:50px ; height: 50px ;  margin-top: 13px;">
            <input <?php if($value["Status"] === true){echo "readonly";}?> class="rounded p-2" min="0" name="KeyTwo" value="<?php echo $datakey[1] ?>" type="hidden">
        </form>

        <div class="col">
            <h2><?php echo $datakey[1]?></h2>
        </div>
        
    </div>
    
    <?php
    }
    
    ?>
    <form class="col d-flex gap-4 " method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input value="RESET" name="RESET" type="hidden">
    <input class="btn btn-warning center center mt-5" value="RESET" type="submit" style="width:200px ; height: 50px; margin-left: 41%; margin-bottom: 41px;">
    </form>


        

        
        

        




<table class="table container text-white" style="background:#8A1538">
            <thead>
                <tr class="bg-white text-black" style="border: 1px solid black">
                    <th scope="col">Teams</th>
                    <th scope="col">Pts</th> 
                    <th scope="col">Mp</th>
                    <th scope="col">GF</th>
                    <th scope="col">GA</th>
                    <th scope="col">W</th>
                    <th scope="col">D</th>
                    <th scope="col">L</th>
                    <th scope="col">GD</th>
                </tr>
            </thead>
            <tbody>

<?php


foreach($resoltMatches as $keyresoltMatches => $valueresoltMatches){

    echo 
    "<tr>
        <th>" . $keyresoltMatches . "</th>
        <td>"  . $valueresoltMatches['PTS.'] . "</td>
        <td>"  . $valueresoltMatches['MP'] . "  </td>
        <td>"  . $valueresoltMatches['GF'] ."  </td>
        <td>"  . $valueresoltMatches['GA'] . "  </td>
        <td>"  . $valueresoltMatches['W'] . "   </td>
        <td>"  . $valueresoltMatches['D'] . "   </td>
        <td>"  . $valueresoltMatches['L'] . "   </td>
        <td>"  . $valueresoltMatches['GD'] . "</td>                   
    </tr>";



    
}

?>



            
            </tbody>
        </table>



       


  

<!-- ::::::::::::::::::::::::::::::::::::::::::::::::: -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>


