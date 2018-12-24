<?php 
    // require_once(__DIR__."web.php");
    // include "web.php";
    // request();
    if(!isset($_SESSION)){
        ob_start();
        session_start();
    }
    
    if($_SESSION['LoginSuccess'] == null){
        header("location:login.php");
    }

        // $requestUrl = (isset($_REQUEST['rquest'])? $_REQUEST['request']: null);
        // $args = explode('/', rtrim($requestUrl));
        
        // $queries = array(
        //     'path' => $_REQUEST['req_path']
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
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Be Unique </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">
    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/logout.js"></script>
        <script>
        $(document).ready(function () {
            $("#search").click(function (event) {

                // $.post('getOOTD.php', {
                //     gender: 'female',
                //     city: $("#location option:selected").text() //whatever this is
                // }, function () {
                //     alert($("#location option:selected").text() );
                // });
                //alert($("#location option:selected").text());
                $.ajax({
                    // url: "http://140.118.109.128:5000/weatherAndOutfits",
                    // method: "POST",
                    // contentType: "application/json",
                    // dataType:'json',
                    // crossDomain: true,
                    type: "POST",
                    data: {
                        gender: "female",
                        city: $("#location option:selected").text()
                    },
                    dataType: "json",
                    url: "getOOTD.php",
                    success: function (data) {
                        console.log(data);
                        $('#loc').text($("#location option:selected").text());
                        $('#text').text(data['text']);
                        $('#rain').text("降雨機率 : " + data['rain']);
                        $('#temp').text("氣溫 : " + data['temp'] + "°C");
                        $('#timeInterval').text(data['timeInterval']);
                        $('#locationWeather').show();
                        $('#url_1').attr("src", data['url_1']);
                        $('#url_2').attr("src", data['url_2']);
                        $('#url_3').attr("src", data['url_3']);
                        $('#style').show();
                        if (~data['text'].indexOf("雨")){
                            $('#textImg').attr("src", "https://image.flaticon.com/icons/png/128/1163/1163626.png");
                        }else if(~data['text'].indexOf("雲")){
                            $('#textImg').attr("src", "https://image.flaticon.com/icons/png/128/1163/1163624.png");
                        }else{
                            $('#textImg').attr("src", "https://image.flaticon.com/icons/png/128/1163/1163662.png");
                        }
                      
                    },
                    error: function (err, status, errorThrown) {
                        console.log($("#location option:selected").text() + "fail");
                        console.log("Data: " + err + "\nStatus: " + status + "\nError: " + errorThrown);
                    }
                });
                event.preventDefault();
            });

        });
    </script>


    <!-- magicImage function -->
    <script type="text/javascript">
            
        $(function()
        {
            $("#myFile").change(function(){
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#photo').attr('src', e.target.result);
                    }               
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }) ;



        $(document).ready(function(){
            $("#send").click(function(event){
            var formData = new FormData();
            formData.append("file", $('input[type=file]')[0].files[0]);
            formData.append("model", $("#model").val());

            $.ajax({
                type: "POST",
                url: "https://m10615816.cf/api/magicImage",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: formData,
                cache: false,
                
                success: function (data) {
                    console.log(data);
                    //$('#photoNew').attr('src','data:image/jpeg;base64,' + data);
                    //console.log(base64encode(data));
                    //$("#photoNew").html('<img src="data:image/png;base64,' + base64encode(data)  + '" />');
                    // $("#photoNew").attr('src', 'data:image/jpeg;base64,' + base64encode(data), e.target.result);
                },
                error: function (error) {
                    console.log("Data: " + err + "\nStatus: " + status + "\nError: " + errorThrown);
                },
                
            }).done(function(response) {
                    console.log(response);
                    //$("#photoNew").html('<img src="data:image/png;base64,' + base64encode(response)  + '" />');
                    $("#photoNew").attr("src","data:image;base64,"+response);
                });
            });
        });
    </script>
    <a herf=<?php $url?>>
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
                        <a class="page-scroll" href="#ootd">#OOTD</a>
                    </li>

                    <li>
                        <a class="page-scroll" href="#magicImage">MAGIC IMAGE</a>
                    </li>

                    <li>
                        <a class="page-scroll " href="logout.php">LOG OUT</a>
                       
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
                <div class="intro-heading"><?php echo $_SESSION['member_id'];?></div>
                <div class="intro-heading">Nice To Meet You!</div>
                <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
            </div>
        </div>
    </header>

    

    <!-- OOTD Section -->
    <section id="ootd" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Outfit of the day</h2>
                    <h3 class="section-subheading text-muted">Accroding to the weather of your location</h3>
                </div>
            </div>
            <div class="container">
                <div class="col-sm-4">
                    <h4 class="subheading" style="text-align: center">location</h4>
                </div>
                <div class="col-sm-4 ">
                    <select class="form-control input m-b" name="location" id="location">
                        <option selected style="display: none"></option>
                        <option selected> 連江縣 </option>
                        <option> 金門縣 </option>
                        <option> 宜蘭縣 </option>
                        <option> 新竹縣 </option>
                        <option> 苗栗縣 </option>
                        <option> 彰化縣 </option>
                        <option> 南投縣 </option>
                        <option> 雲林縣 </option>
                        <option> 嘉義縣 </option>
                        <option> 屏東縣 </option>
                        <option> 臺東縣 </option>
                        <option> 花蓮縣 </option>
                        <option> 澎湖縣 </option>
                        <option> 基隆市 </option>
                        <option> 新竹市 </option>
                        <option> 嘉義市 </option>
                        <option> 臺北市 </option>
                        <option> 高雄市 </option>
                        <option> 新北市 </option>
                        <option> 臺中市 </option>
                        <option> 臺南市 </option>
                        <option> 桃園市 </option>
                    </select>
                </div>
                <div class="col-sm-4 text-center">
                    <button type="submit" class="btn" id="search">search</button>
                </div>
            </div>



            <div class="container" style="display:none;margin-top: 100px " id="locationWeather">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h2 class="section-heading text-center" id="loc" style="margin-top:30px">Taipei</h2>
                        <h3 class="section-subheading text-muted text-center" id="timeInterval">2018-12-14 21:00:00 <br>2018-12-15
                            00:00:00</h3>
                    </div>

                    <div class="col-sm-4">
                        <div class="">
                            
                            <img src="https://image.flaticon.com/icons/png/128/1163/1163666.png"
                                class="img-responsive img-circle img-centered" alt="" height="100" width="100" id="textImg">
                                <h4 style="text-align: center" id="text">QQ</h4>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                            <h4 id="rain"> 降雨機率</h4>
                            <h4 id="temp">氣溫</h4>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <p class="large text-muted"></p>
                    </div>
                </div>
            </div>


            <div class="row" style="display:none" id="style">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img id="url_1" src="" class="img-responsive">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Style 1</h4>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img id="url_2" src="" class="img-responsive">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Style 2</h4>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img id="url_3" src="" class="img-responsive">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Style 3</h4>
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
     <!-- magicImage Section -->
    <section id="magicImage">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Magic Image</h2>
                    <h3 class="section-subheading text-muted">Upload your pohto and get a new one with filter.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="col-sm-4">
                                
                                <label>Upload your pohto:</label>
                                <a href="javascript:;" class="file">
                                    <input type="file" name="myFile" id="myFile" accept="image/jpeg, image/png">
                                </a> 
                                
                        </div>
                        <div class="col-sm-4">
                            <label>Select a model:</label>
                                <select class="form-control input m-b" id="model" name="model">
                                    <option value="MODEL_CANDY">Candy</option>
                                    <option value="MODEL_UDNIE">Udnie</option>
                                    <option value="MODEL_MOSAIC">Mosaic</option>
                                    <option value="MODEL_RAIN">Rain</option>
                                </select>                                    
                        </div> 
                        <div  style="text-align:center;" class="col-sm-4 text-center">         
                            <button type="submit" id="send" class="page-scroll btn btn-xl">Send</button>                                    
                        </div> 
                        
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="container">
                        <div class="col-sm-6">
                                <br>
                                <br>
                                <label>BEFORE</label> 
                            <img id="photo" width="500px" src="">
                        </div>
                        <div class="col-sm-6">
                                <br>
                                <br>
                                <label>AFTER</label> 
                                <img id="photoNew" width="500px" src="">
                        </div>    
                                       
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </section>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>
