<?php

session_name('easy-contact');
session_start();

// Captcha setup
$captcha = array(rand(1,10),rand(1,10));

$ops = array('+','-','x');
$op = $ops[rand(0,2)];

switch ($op) {
    case '+':
        $_SESSION['expected'] = $captcha[0] + $captcha[1];
        break;
    case '-':
        if($captcha[0] < $captcha[1]){
            $temp = $captcha[0];
            $captcha[0] = $captcha[1];
            $captcha[1] = $temp;
        }
        $_SESSION['expected'] = $captcha[0] - $captcha[1];
        break;
    case 'x':
        $_SESSION['expected'] = $captcha[0] * $captcha[1];
        break;
}
// Captcha setup end

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Easy Contact Form - Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="easy ajax contact form">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/easy-contact.js" type="text/javascript"></script>

    <style>
      body {
          background-color: #eee;
      }

      .container {
          background-color: white;
          border-radius: 4px;
          margin-top: 20px;
          min-height: 600px;
          border: 1px solid #bdc3c7;
      }
    </style>
  </head>
  <body>
    <div class="container">

        <div class="page-header">
            <h1>
                Easy Ajax Contact Form <small>DEMO</small>

                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Example 2 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="example.php">Example 1</a></li>
                        <li><a href="example-2.php">Example 2</a></li>
                        <li><a href="example-3.php">Example 3</a></li>
                    </ul>
                </div>
            </h1>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <p class="alert alert-danger" id="eac-alert" style="display: none"></p>
            <p class="alert alert-success" id="eac-thanks" style="display: none"></p>

            <form class="form form-horizontal" id="eac-form" method="post">

                <div class="col-sm-6" style="padding-right: 6%;">
                    <div class="form-group">
                        <label >Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label >Subject:</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Captcha:</label>
                        <div>
                            <div class="form-control-static" style="float: left">
                                <?php echo $captcha[0].' '.$op.' '.$captcha[1]?> =
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <input type="text" name="captcha" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label >Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label >Message:</label>
                        <textarea name="message" class="form-control" rows="6" required></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr/>
                <button type="submit" class="btn btn-danger pull-right">Submit</button>
            </form>
        </div>
    </div>

    <footer class="text-center" style="position: absolute; bottom:10px; width:100%;">
        © 2014 Easy Ajax Contact Form - Made with <span class="glyphicon glyphicon-heart"></span>
    </footer>
  </body>
</html>