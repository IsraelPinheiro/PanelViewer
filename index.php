<?php
    $files = glob('temp/*'); // get all file names
    foreach ($files as $file) { // iterate files
        if (is_file($file)) {
            unlink($file); // delete file
        }
    }
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>   
        <section>
            <form id="MainForm" action="viewer.php" method="POST" enctype="multipart/form-data">
                <div class="row mx-auto align-middle">
			        <div class="col-md-6 offset-3">
                        <label for="Imagens">Slides</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 
                                <input type="file" multiple class="custom-file-input" id="Imagens" name="Imagens[]" accept="image/*" required>
                                <label id="NomeArquivo" class="custom-file-label noafter" for="Imagens">Escolha as Imagens</label>
                            </div>
                            <div class="input-group-append">
                                <label class="input-group-text" for="Imagens"><i class="fas fa-search"></i></label>
                            </div>
                            <div class="input-group-append d-none">
                                <button class="btn btn-danger btn-remove" type="button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                            <div class="input-group-append d-none">
                                <button class="btn btn-primary btn-go" type="button"><i class="fas fa-play-circle"></i></button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 offset-3">
                        <div class="form-group">
                            <label for="Time">Intervalo (Segundos)</label>
                            <input type="number" class="form-control" name="Time" value="10" min="1" max="60">
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>