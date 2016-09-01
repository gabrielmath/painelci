function sticky_footer() {
    var mFoo = $("footer");
    if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) {
        mFoo.css({ position: "fixed", bottom: "0px" });
    } else {
        mFoo.css({ position: "static" });
    }
}

function alturaTela() {
    var alturaTela = $(window).height();
    var largTela = $(window).width();
    $(".slide").css('min-height', alturaTela);
    // $("#footer").css('min-height', alturaTela);
}

function linkLatAtivo(link) {
    if (!($(link).parent().hasClass("ativo"))) {
        $("ul.menu li a").parent().removeClass("ativo");
        $(link).parent().addClass("ativo");
    }
}

function exibeComScroll()
{
    $(".slide").each(function (i)
    {
        var div = $(this).offset().top;
        //var tela = $(window).scrollTop() + ($("nav").outerHeight());
        var tela = $(window).scrollTop() + ($(window).height()/2);
        var link = $("ul.menu li a");
        

        if(tela >= div)
        {
            if ($(this).is("#header")) {
                linkLatAtivo($("ul.menu li:nth-child(1) a"));
            }
            else if ($(this).is("#portaria")) {
                linkLatAtivo($("ul.menu li:nth-child(2) a"));
            }
            else if ($(this).is("#limpeza")) {
                linkLatAtivo($("ul.menu li:nth-child(3) a"));
                $(".efeito1,.efeito2,.efeito3").removeClass('esconde');
                $(".efeito1, .efeito3").addClass('fadeInDown');
                $(".efeito2").addClass('fadeInUp');
            }
            // else if ($(this).is("#zeladoria")) {
            //     linkLatAtivo($("ul.menu li:nth-child(4) a"));
            // }
            else if ($(this).is("#manutencao")) {
                linkLatAtivo($("ul.menu li:nth-child(4) a"));
            }
            else if ($(this).is("#monitoramento")) {
                linkLatAtivo($("ul.menu li:nth-child(5) a"));
            }
            // else if ($(this).is("#parceiros")) {
            //     linkLatAtivo($("ul.menu li:nth-child(7) a"));
            // }
            else if ($(this).is("#footer")) {
                linkLatAtivo($("ul.menu li:nth-child(6) a"));
            }
        }
    });
}

// function alturaTela() {
//     var alturaTela = $(window).height();
//     $("#topo, #meio").css('height', alturaTela);
// }

$(document).ready(function () {
    sticky_footer();
    $(window).scroll(sticky_footer);
    $(window).resize(sticky_footer);
    $(window).load(sticky_footer);
    alturaTela();
    $(window).scroll(alturaTela);
    $(window).resize(alturaTela);
    $(window).load(alturaTela);

    $("#abreFechaMenu").click(function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).animate({'margin-left':'300px'})
            $("aside").animate({'margin-left':'0px'});
        }
        else{
            $(this).animate({'margin-left':'0px'})
            $("aside").animate({'margin-left':'-300px'});
        }
    });

    $(".carousel2").carousel({
        pause:false
    });

    $("ul.menu li a").click(function(event){
        // event.preventDefault();
        linkLatAtivo(this);
        // $('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
    });

    $(window).scroll(exibeComScroll);
    $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
        exibeComScroll();
    });

    setTimeout(function(){
        $("#imgLogo,#header h2").removeClass('esconde');
        $("#header h2").addClass('fadeInUp');
        $("#imgLogo").addClass('fadeInDown');
    }, 1700);

    // $("#more").More({
    //     'position': "vertical"
    // });

    // console.table($("#more").More());
    
});