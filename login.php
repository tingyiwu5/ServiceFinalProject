<?php 
session_start(); 
ob_start();

// See: http://blog.ircmaxell.com/2013/02/preventing-csrf-attacks.html
// Create a new CSRF token.
if (! isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
// Check a POST is valid.
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // POST data is valid.
}

    // $requestUrl = (isset($_REQUEST['rquest'])? $_REQUEST['request']: null);
    //     $args = explode('/', rtrim($requestUrl));

        // $queries = array(
        //     // 'path' => $_REQUEST['req_path']
        // );

        // $basepath = 'C:/xampp/htdocs/finalproject/';
        // $realBase = $basepath."?".http_build_query($queries);

        // //Return 404 if path doesn't exist
        // if(!file_exists($realBase)){
        //     return http_response_code(404);
        // }

        // if (is_file($realBase)){
        //     $url = http_send_file($realBase);
        // }

        // $files = rewinddir($realBase);
        // $url = $files.php;
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Be Unique</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

    
    <!-- CSRF -->
    <!-- https://gist.github.com/ziadoz/3454607 -->
    <script>
    window.csrf = { csrf_token: '<?php echo $_SESSION['csrf_token']; ?>' };
    $.ajaxSetup({
        data: window.csrf
    });
    $(document).ready(function() {
        // CSRF token is now automatically merged in AJAX request data.
        $.post('/awesome/ajax/url', { foo: 'bar' }, function(data) {
            console.log(data);
        });
    });
    </script>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Be Unique</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#login">Log In</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Our Studio!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#login" class="page-scroll btn btn-xl">Log In</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Log In</h2>
                    <h3 class="section-subheading text-muted">Please log in your account to use our service.</h3>
                </div>
            </div>
            <form method="POST" action="login.php?page=login">
                <div class="form-group col-md-6">
                    <!-- <script src="login.php"></script> -->
                    <!-- <div class="col-md-6">-->
                        <h4 class="service-heading team-member">User</h4>
                        <label>Account Id</label>
                        <input type="text" class="form-control" name="loginAccount" placeholder="Enter account">
                        <!-- CSRF -->
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                        <label>Password</label>
                        <input type="password" class="form-control" name="loginPassword" placeholder="Enter password">
                        <!-- CSRF -->
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                        <p></p>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    <!-- </div> -->
                </div>
            </form>
            <form method="POST" action="login.php?page=register">
                <div class="form-group col-md-6">
                    <!-- <script src="register.php"></script> -->
                    <h4 class="service-heading team-member">Register</h4>
                    <label>Account Id</label>
                    <input type="text" class="form-control" name="registerAccount" placeholder="Enter account">
                    <!-- CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                    <label>Password</label>
                    <input type="password" class="form-control" name="registerPassword" placeholder="Enter password">
                    <!-- CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                    <label>Gender</label>
                    <div>
                        <select class="form-control input m-b" name="registerGender">
                            <option selected style="display: none;"></option>
                            <option>Male</option>
                            <option>Female</option>                 
                        </select>
                    </div>
                    <!-- <input type="password" class="form-control" name="registerGender"> -->
                    <p></p>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </section>

   

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>


<?php
    // use PDO to connect database
    if($_POST){
        
        //link to database
        $db_host = "localhost";
        $db_name = "finalproject";
        $db_user = "root";
        $_SESSION['LoginSuccess'] = null;
        $salt = 'beuniquehash'; 
        
        try{
            $conn = new PDO("mysql:host=".$db_host.";dbname=".$db_name,$db_user,'');
            $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die ($e ->getMessage());
        }

        
        if($_GET['page']=='login'){

            $id = $_POST['loginAccount'];
            $pw = $_POST['loginPassword'];        

            if (preg_match('/^([0-9A-Za-z]+)$/', $id) && preg_match('/^([0-9A-Za-z]+)$/', $pw)){

                $prepare_id = $id;
                $prepare_pw = md5($salt.$pw);

                //SELECT data from table
                $sql_id= "SELECT * FROM member_table where member_id = '{$prepare_id}'";
                $sql_pw= "SELECT * FROM member_table where pwd = '{$prepare_pw}'";
                $result_id = $conn -> prepare($sql_id);
                $result_pw = $conn -> prepare($sql_pw);
                $result_id ->execute(array($prepare_id));
                $result_pw ->execute(array($prepare_pw));
                $id_result = $result_id ->fetchAll();
                $pw_result = $result_pw ->fetchAll();

                if($id_result == null){
                    echo "<script> alert ('This account does not exist! Please register an account!') </script>";

                }else if ($pw_result == null){
                    echo "<script> alert ('Wrong password! Please type in the correct password!')</script>";
            
                }else{
                    foreach($id_result as $row_id){

                        foreach($pw_result as $row_pw){
                            if($prepare_id != null && $prepare_pw != null && $row_id['member_id'] == $prepare_id && $row_pw['pwd'] == $prepare_pw){
                                
                                $_SESSION['LoginSuccess'] = 1;
                                $_SESSION['member_id'] = $prepare_id;
                                $_SESSION['pwd'] = $prepare_pw; 
                                echo "<script> alert ('Log in successful!') </script>";

                                //direct to index.php
                                header('location:index.php');
                                exit();
                                ob_end_flush();
                            
                            }else if ($prepare_id == null){
                                echo "<script> alert ('The id cannot blank! Please type in your id!') </script>";
                                //this cannot execute
                            }else if ($prepare_pw == null){
                                echo "<script> alert ('The password cannot blank! Please type in your password!') </script>";
                                //this cannot execute
                            }
                        }
                    }
                }
            }else{
                echo "<script> alert ('Wrong format! The id and password only can contain letters and numbers!')</script>";
            }   
            
        }else{
            $member_id = $_POST['registerAccount'];
            $member_pw = $_POST['registerPassword'];
            $gender = $_POST['registerGender'];

            if (preg_match('/^([0-9A-Za-z]+)$/', $member_id) && preg_match('/^([0-9A-Za-z]+)$/', $member_pw)){

                $pre_member_id = $member_id;
                $pre_member_pw = md5($salt.$member_pw);
                $pre_gender = $gender;

                //SELECT data from table
                $member_sql= "SELECT * FROM member_table where member_id = $pre_member_id";
                // $member_result = $conn -> query($member_sql);
                $member_result = $conn -> prepare($member_sql);
                $member_data_result = $member_result ->fetchAll();
                
                if ($member_data_result == null && $pre_member_id != null && $pre_member_pw != null && $pre_gender != null){
                    
                    //if member_id doesn't exist in member_table && id,pw,gender are not null, insert into meber_table$_SESSION['member_id'] = $member_id; 
                    $_SESSION['member_id'] = $pre_member_id;
                    $_SESSION['pwd'] = $pre_member_pw;
                    $_SESSION['gender'] = $pre_gender;
                    $_SESSION['LoginSuccess'] = 1;

                    $sql = "INSERT INTO member_table(member_id, pwd, gender) VALUES ('".$_SESSION['member_id']."','".$_SESSION['pwd']."','".$_SESSION['gender']."')";
                    
                    //http://www.bggcs.com/168/php-pdo-db
                    $select = $conn -> prepare($sql);
                    $select ->execute(array($sql));

                    echo "<script> alert ('Account creates successful!') </script>";
                    
                    //direct to index.php
                    header('location:index.php');
                    ob_end_flush();

                }else if ($member_data_result != null){
                    echo "<script> alert ('This account already exist!') </script>";

                }else if ($pre_member_id == null){
                    echo "<script> alert ('The id cannot blank!') </script>";
                     //this cannot execute
                }else if ($pre_member_pw == null){
                    echo "<script> alert ('The password cannot blank!') </script>";
                     //this cannot execute
                }else if ($pre_gender == null){
                    echo "<script> alert ('The gender annot blank!'') </script>";
                }    //this cannot execute
            
            }else{
                echo "<script> alert ('Wrong format! The id and password only can contain letters and numbers!')</script>";
            }


        }
    }   
    // mysql_close($Link);
?>
    