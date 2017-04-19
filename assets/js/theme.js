$(document).ready(function(){
    $('.live-search-list li').each(function(){
       $(this).attr('data-search-term', $(this).text().toLowerCase());
    });

    $('.live-search-box').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();

        if (searchTerm == '') {
            $('.live-search-list li').each(function() {
                for (var i = 0; i < 12; i++) {
                    $(this).show();
                }
            });
        } else {
            $('.live-search-list li').each(function() {
                if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

    });

    $('.live-search-list li').on('click', function() {
        $('.live-search-box').val($(this).html());
    });

    $(function() {
        $("#form").submit(function(e) {
            e.preventDefault();

            $('#go').toggle('loading');
            var actionurl = e.currentTarget.action;

    		$.ajax({
    			type: "POST",
    			url: "http://localhost/inovaAPI/public/api.php/add",
    			data: {
    				curso: $("#curso").val(),
    				nome: $("#nome").val(),
    				email: $("#email").val(),
    				telefone: $("#telefone").val(),
    				cpf: $("#cpf").val(),
                    descricao: '',
    				token: $("#token").val()
    			},
    			success: function(data){
                    console.log(data);
                    $('#go').toggle('loading');

                    if (data == 'Ok') {
                        alert("Cadastro realizado com sucesso");
                        clean();
                    } else {
                        alert("Ocorreu um erro ao cadastrar");
                        clean();
                    }
    			}
    		});
        });
    });

    function clean() {
        $("#curso").val('');
        $("#nome").val('');
        $("#email").val('');
        $("#telefone").val('');
        $("#cpf").val('');
    }

    $('.demo.menu .item').tab({history:false});
	$('.ui.radio.checkbox').checkbox();
});
