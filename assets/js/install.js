/**
 * Created by d3s4st3r - ezTools.
 *            _____           _
 *    ___ ___|_   _|__   ___ | |___
 *   / _ \_  / | |/ _ \ / _ \| / __|
 *  |  __// /  | | (_) | (_) | \__ \
 *   \___/___| |_|\___/ \___/|_|___/
 *
 * User: D3
 * Date: 06.09.2016
 * Time: 19:07
 */


$(document).ready(function() {
    Materialize.updateTextFields();
    $('select').material_select();
});

/*$('#preview').click(function(){
    var values = $('#configuration').serialize();
    var url = 'index.php?override_settings&'+values;
    window.open(url, '_blank');
});*/

$('.add_item').click(function(){
    var id = $(this).data('id');
    var selector = $('#'+id);
    if(selector.hasClass('specialfield')){
        $(this).data('number', $(this).data('number')+1);
        var number = $(this).data('number');
        selector.append('<div class="input-field col s6"><input name="'+id+'['+number+'][\'date\']" type="text" placeholder="Place your date here!" class="validate"></div>');
        selector.append('<div class="input-field col s6"><input name="'+id+'['+number+'][\'text\']" type="text" placeholder="Place your news here!" class="validate"></div>');
    }else{
        selector.append('<div class="input-field col s6"><input name="'+id+'[]" type="text" placeholder="Place your text here!" class="validate"></div>');
    }
});

$('.remove_item').click(function(){
    var id = $(this).data('id');
    var selector = $('#'+id);
    var target = $('#'+id+' .input-field:last-child');
    if(selector.hasClass('specialfield')){
        var target2 = $('#'+id+' .input-field:nth-last-child(2)');
        if($('#'+id+' .input-field').length > 2){
            target.remove();
            target2.remove();
        }
    }else{
        if($('#'+id+' .input-field').length > 1){
            target.remove();
        }
    }
});

$('#preview').click(function(){
    var that = $(this);
    var values = $('#configuration').serialize();
    var ip = $('#user_ip').html();
    values = values+'&method=preview&ip='+ip;
    //console.log(values);
    $.ajax({
        method: "POST",
        url: "assets/php/ajax.php",
        data: values
    })
    .done(function(e){
        if(e == true){
            var url = 'index.php?override_settings';
            /*var popup = window.open(url, '_blank');
            if(!popup || popup.closed || typeof popup.closed=='undefined'){
            	alert('Preview popup blocked. Allow it to use it properly.');
            }*/
            that.iframe({
                id : 'iframe',
                url : url,
                width : '100%',
                height : '100%',
                append : '.iframe_content',
                background : '.iframe_background',
                method : 'show'
            });
        }else{
            //console.log(e);
            alert('Something went wrong, try again or contact the author!');
        }
    })
    .fail(function(e){
        //console.log(e);
        alert('Something went badly wrong, try again or contact the author!');
    });
});

$('.close_tab, .iframe_background').click(function(e){
    $(this).iframe({
        method : 'close'
    });
});

$(document).on('change','#language_field',function(){
    var changed_to = $(this).val();
    $('.language_overview').slideUp();
    $('.language_overview').promise().done(function(){
        $('#__'+changed_to).slideDown();
    });
});