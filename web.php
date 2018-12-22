   <?php
    require_once(__DIR__."/index.php");
    require_once(__DIR__."/login.php");

    function request(){
        // $requestUrl = (isset($_REQUEST['rquest'])? $_REQUEST['request']: null);
        // $args = explode('/', rtrim($requestUrl));
        
        $queries = array(
            // 'path' => $_REQUEST['req_path']
        );

        $basepath = 'C:/xampp/htdocs/finalproject/';
        $realBase = $basepath."?".http_build_query($queries);

        //Return 404 if path doesn't exist
        if(!file_exists($realBase)){
            return http_response_code(404);
        }

        if (is_file($realBase)){
            $url = http_send_file($realBase);
        }

        $files = rewinddir($realBase);
        $url = $files.php;
    }
    ?>
