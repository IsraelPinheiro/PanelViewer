$(document).ready(function(){
    $(document).on("click", ".btn-remove",function(){
        $("#Imagens").val(null)
        $("#Imagens").change()
    });
    $(document).on("click", ".btn-go",function(){
        $("#MainForm").submit()
    });
    $(document).on("change", "#Imagens", function(event){
        if($("#Imagens").val()){
            console.log(event.target.files.length)
            if(event.target.files.length==1){
                $("#NomeArquivo").text(event.target.files[0].name)
            }
            else{
                $("#NomeArquivo").text(event.target.files.length+" Arquivos Selecionados")
            }
            $(".btn-remove").parent().removeClass("d-none")
            $(".btn-go").parent().removeClass("d-none")
        }
        else{
            $("#NomeArquivo").text("Escolha as Imagens")
            $(".btn-remove").parent().addClass("d-none")
            $(".btn-go").parent().addClass("d-none")
        }
    })
})