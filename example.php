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
    <link href="css/easy-contact.css" rel="stylesheet">

   <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/easy-contact.js" type="text/javascript"></script>

  </head>
  <body>
    <div class="container">

        <div class="page-header">
            <h1>Easy Ajax Contact Form <small>DEMO</small></h1>
        </div>

        <div class="col-sm-9">
            <p class="alert alert-danger" id="eac-alert" style="display: none"></p>
            <form class="form form-horizontal" id="eac-form" method="post">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Name (*):</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Email (*):</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Subject (*):</label>
                        <div class="col-sm-8">
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4"><?php echo $captcha[0].' '.$op.' '.$captcha[1]?> = </label>
                        <div class="col-sm-8">
                            <input type="text" name="captcha" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
            <p class="alert alert-success" id="eac-thanks" style="display: none"></p>
        </div>
    </div>

    <footer class="text-center" style="position: absolute; bottom:10px; width:100%;">
        © 2014 Easy Ajax Contact Form
    </footer>
  </body>
</html>