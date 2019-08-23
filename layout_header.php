<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 
    <title><?php echo $page_title; ?></title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  
    <!-- our custom CSS -->
    <link rel="stylesheet" href="custom.css" />
    <style>
    .navbar-nav {
    float: right;
    margin-right: 24px;
}
.navbar{
   background-image: linear-gradient(-140deg, #2c7dbc 15%, #7cccc5 70%);
   -webkit-box-shadow: -3px 13px 24px -1px rgba(0,0,0,0.3);
   box-shadow: -3px 13px 24px -1px rgba(0,0,0,0.3);
}
.navbar > .container .navbar-brand, .navbar > .container-fluid .navbar-brand {
    margin-left: -15px;
    color: white;
}
.navbar-default .navbar-nav > li > a {
    color: white;
}

  </style>
</head>
<body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">DOT OPERATING AUTHORITY</a>
    </div>
    <ul class="nav navbar-nav">
   <li><a href='index.php'>Manage Records</a></li>
   <li><a href='create_records.php'>Create Records</a></li>
   <li><a href='active_records.php'>Active Records</a></li>
    </ul>
  </div>
</nav>
    <!-- container -->
    <div class="container">
 
        <?php
        // show page header
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
        ?>