<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>PanelViewer</title>
        <!--JQuery Slim-->
        <script src="bin/jquery/jquery.slim.min.js"></script>
        <!--Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="bin/popper.js/popper.min.js"></script>
        <script src="bin/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/viewer.js"></script>
        <link rel="stylesheet" href="css/viewer.css">
    </head>
    <body>
        <div class="container-fluid">
            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval='<?php echo $_POST['Time'] * 1000 ?>'>
                <div class="carousel-inner">
                    <?php
                        $count = 0;
                        foreach ($_FILES['Imagens']['name'] as $filename) {
                            $temp = 'temp/';
                            $tmp = $_FILES['Imagens']['tmp_name'][$count];
                            $count = $count + 1;
                            $temp = $temp.basename($filename);
                            move_uploaded_file($tmp, $temp);
                            echo "
                                <div class='carousel-item'>
                                    <img src='$temp' class='d-block w-100'>
                                </div>";
                            $temp = '';
                            $tmp = '';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
