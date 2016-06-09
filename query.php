<?php

    include_once ("search.php");
    $connect = new Connect();
    $search = $connect->search_term();
    $number = $connect->rows();
    $time = $connect->loading();
    $search;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lost And Found</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style>body{padding-top:50px;}.starter-template{padding:40px 15px;text-align:center;}</style>

    <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">
  
        #body-info p{
                      margin: 0;
                  }
        #name{
              color: blue;
            }
        #location{
                  color: green;
                }
        #warning{
                 margin-top: 10%;
              }
        #social{
                margin-top: 25%;
              }
        #form{
              margin-top: 4%
             }
        #sidebar{
                 margin-top: 6%;
                }

  </style>

</head>
<body>
  
<div class="container">
    <div class="col-xs-8">
            <form class="form-horizontal" id="form" role="form" action="query.php" method="GET" enctype="multipart/form-data"> 
	            <div class="input-group">
      			      <input type="text" name="q" class="form-control" value="<?php echo $_GET['q']; ?>">
      			         <span class="input-group-btn">
      			             <input class="btn btn-success" name="submit" type="submit" value="GO!"></input>
			               </span>
			        </div>
			      </form>
    </div>

    <div class="col-xs-6">

      <?php 
            if($search == FALSE){
                                 echo "<br /><p> Search Term Too Short!<br/> Please Try Again.</b><p>";
            }else{
                   echo "<br /><p> You Searched For <strong>' " .$search. "'</strong><p>";
            }
  
              if($number == 0){
                                echo "No Results Found!";
              }else{
                    echo "<p>" .$number. " Result(s) Found in " .$time. " Seconds!</p><br />";
              }
        ?>

      <div id="body-info">
          <?php
             $connect->results();
          ?>
      </div>
   
    </div>

      <div class="col-xs-4 col-sm-offset-1 blog-sidebar" id="sidebar">
              <div class="sidebar-module sidebar-module-inset">
                <h4>About Our Service</h4>
                <p>“When you lose an ID in Kenya, it costs a lot of money and can take up to three months to replace it so the service we are providing will help a lot of people and also save the government millions of shillings used to reprint ID’s, allowing them to focus on more important issues.”</p>
              </div>

          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">Telegram</a></li>
              <li><a href="#">Whatsapp</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        
      </div>

</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
