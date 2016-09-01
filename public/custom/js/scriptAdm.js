function sticky_footer() {
    var mFoo = $("footer");
    if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) {
        mFoo.css({ position: "fixed", bottom: "0px" });
    } else {
        mFoo.css({ position: "static" });
    }
}

$(document).ready(function(){

    $('#example').DataTable({
        responsive: true,
        language:{
            "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
        },
        sScrollY: "400px",
        sScrollX: "100%",
        sScrollXInner: "100%",
        order: [[0, 'asc']]
    });

    $('#table-auditoria').DataTable({
        responsive: true,
        language:{
            "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
        },
        sScrollY: "400px",
        sScrollX: "100%",
        sScrollXInner: "100%",
        order: [[1, 'desc']]
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Mantém rodapé fixo no final da tela
	sticky_footer();
    $(window).scroll(sticky_footer);
    $(window).resize(sticky_footer);
    $(window).load(sticky_footer);

    // Mostrar/Ocultar senha no cadastro/atualização
    $("#verSenha").click(function(e){
        e.preventDefault();
        $("#verSenha span").toggleClass('exibirS');

        if($("#verSenha span").hasClass('exibirS')){
            $("#txtSenha").attr('type','text');
            $("#verSenha span").removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
        }
        else{
            $("#txtSenha").attr('type','password');
            $("#verSenha span").removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
        }
    });

    // Deleta Registro - Usuários
    $('.deletareg').click(function(){
        if(confirm("Deseja realmente excluir este registro?\nEsta operação não poderá ser desfeita!"))
            return true;
        else
            return false;
    });

    // Seleciona texto dentro de input
    $(".linkImg").click(function(){
        $(this).select();
    });

    // Editor de HTML TINYMCE
    // tinymce.init({
    //     selector:'.htmleditor',
    //     plugins: [
    //         'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
    //         'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
    //         'save table contextmenu directionality emoticons template paste textcolor imagetools'
    //     ],
    //     language: 'pt_BR',
    //     language_url: './htmleditor/langs/pt_BR.js',
    //     content_css: '../../dist/css/bootstrap.min.css',
    //     image_advtab: true,
    //     image_list: 'http://localhost:8080/painelci/admin/midia/get_midias'
    // });

    $('.htmleditor').tinymce({
        // selector:'.htmleditor',
        script_url: 'http://localhost:8080/painelci/htmleditor/tinymce.min.js',
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        language: 'pt_BR',
        language_url: './htmleditor/langs/pt_BR.js',
        content_css: '../../../dist/css/bootstrap.min.css',
        image_advtab: true,
        image_prepend_url: 'http://localhost:8080/painelci/uploads/',
        image_list: 'http://localhost:8080/painelci/admin/midia/get_midias'
    });

    // Busca imagens dinamicamente
    $('.buscarImg').click(function(){
        var url = 'http://localhost:8080/painelci/admin/midia/get_imgs';
        var dados = $(".txtBuscar").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: dados,
            success: function(retorno){
                $('.retornoImg').html(retorno);
            }
        });
    });

    // Limpa as busca das imagens
    $('.limparImg').click(function(){
        $("txtBuscar").val('');
        $(".retornoImg").html('');
    });
    
});