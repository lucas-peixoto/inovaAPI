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

    $('.demo.menu .item').tab({history:false});
	$('.ui.radio.checkbox').checkbox();
});
