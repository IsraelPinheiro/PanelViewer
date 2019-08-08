<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>PanelViewer</title>
        <!--JQuery Slim-->
        <script src="vendor/jquery/jquery.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!--Bootstrap -->
        <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="vendor/bootstrap/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="js/viewer.js"></script>
        <link rel="stylesheet" href="css/viewer.css">
    </head>
    <body>
        <div class="container-fluid">
            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval='<?php echo $_POST['Time']*1000 ?>'>
                <div class="carousel-inner">
                    <?php
                        $count=0;
                        foreach ($_FILES['Imagens']['name'] as $filename) {
                            $temp='temp/';
                            $tmp=$_FILES['Imagens']['tmp_name'][$count];
                            $count=$count + 1;
                            $temp=$temp.basename($filename);
                            move_uploaded_file($tmp,$temp);
                            echo "
                                <div class='carousel-item'>
                                    <img src='$temp' class='d-block w-100'>
                                </div>";
                            $temp='';
                            $tmp='';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
