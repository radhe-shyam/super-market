$(document).ready(function(){
$('#s').click(function(){
    $.post('php/login.php', {u:$('#u').val(), p:$('#p').val()}, function(data){
        if(data == "")
        {
            $('#ip').html("Incorrect Username or Password!"); 
        }
    else {
        location.reload();
        }
    });
});
$('#rs').click(function(){
    $.post('php/register.php', {rn:$('#rn').val(), re:$('#re').val(), rp:$('#rp').val()}, function(data){
    if(data == "0")
        {
            $('#mar').html("Email address is already registered!"); 
        }
    else if(data == "1") {
        $('#mar').html("<script>alert('You are successfully registered.'); window.location=\"index.php\"</script>"); 
        }
    });
});
var ce=1;
$('a[title="Refresh Image"]').click(function(){ce=1;});
$('#captcha_code').focusout(function(){
    if($('#captcha_code').val() != ""){
    $.post('php/cc.php',{c:$('#captcha_code').val()}, function(d){
        if(d == "")
            {
            $('#e').html("Captcha is not correct");
            document.getElementById('captcha_image').src = './captcha/securimage_show.php?' + Math.random(); this.blur();
            ce=1;
            }
        else{
            $('#e').html("");
            ce=0;
            }
    });
    }
});
$('#os').submit(function(){
        if(ce == 0)
            return true;
        else
            {
            $('#e').html("Captcha is not correct");
            return false;
        }
    
});
var i=1;
$('input[value="Add more features"]').click(function(){
    if(i < 21){
        $('#ef').html($('#ef').html() + "<div class=\"rdj\" id=\"ef" + i + "\"><label>Extra Feature :</label><input  type=\"button\" value=\"Remove\" class=\"pull-right btn-xs\"><br><label>Feature title :</label><input required type=\"text\" class=\"form-control\" name=\"ft" + i + "\" placeholder=\"Give feature a title\"><br><label>Feature Description :</label><textarea required class=\"form-control\" name=\"fd" + i + "\" placeholder=\"Give feature description in detail\" rows=\"3\"></textarea><br></div>");
        $("input[name=\"ft" + i + "\"]").focus();
        i++;
        }
    else{
        alert("Maximum 20 extra features can be added.");
        $('input[value="Add more features"]').hide();
        }
});
/*$('input[class="pull-right btn-xs"]').click(function(){
    alert($(this).get(0));
});*/
$('rdj').click(function(){
    alert($(this).get());
});

});