$(document).ready(function() {
    
    
    
    $('#s').click(function() {
        $.post('php/login.php', {u: $('#u').val(), p: $('#p').val()}, function(data) {
            if (data == "1")
            {
                location.reload();
            }
            else {
                 $('#ip').html("Incorrect Username or Password!");
                 $('#ip').html(Math.random());
                         
            }
        });
    });
    $('#rs').click(function() {
        $.post('php/register.php', {rn: $('#rn').val(), re: $('#re').val(), rp: $('#rp').val()}, function(data) {
            if (data == "0")
            {
                $('#mar').html("Email address is already registered!");
            }
            else if (data == "1") {
                $('#mar').html("<script>alert('You are successfully registered.'); window.location=\"index.php\"</script>");
            }
        });
    });
    var ce = 1;
    $('a[title="Refresh Image"]').click(function() {
        ce = 1;
    });
    $('#captcha_code').focusout(function() {
        if ($('#captcha_code').val() != "") {
            $.post('php/cc.php', {c: $('#captcha_code').val()}, function(d) {
                if (d == "")
                {
                    $('#e').html("Captcha is not correct");
                    document.getElementById('captcha_image').src = './captcha/securimage_show.php?' + Math.random();
                    this.blur();
                    ce = 1;
                }
                else {
                    $('#e').html("");
                    ce = 0;
                }
            });
        }
    });
    $('#os').submit(function() {
        if (ce == 0)
            return true;
        else
        {
            $('#e').html("Captcha is not correct");
            return false;
        }

    });
    var i = 0, j = 0;
    $('input[value="Add more features"]').click(function() {
        if (i < (j + 20)) {
            $('#ef').append("<div><label>Extra Feature :</label><input  type=\"button\" value=\"Remove\" class=\"pull-right btn-xs r\"><br><label>Feature title :</label><input required type=\"text\" class=\"form-control\" name=\"ft" + i + "\" placeholder=\"Give feature a title\"><br><label>Feature Description :</label><textarea required class=\"form-control\" name=\"fd" + i + "\" placeholder=\"Give feature description in detail\" rows=\"3\"></textarea><br></div>");
            $("input[name=\"ft" + i + "\"]").focus();
            i++;
            $(".r").bind('click', function() {
                if (confirm('Do you want to remove this feature?')) {
                    $(this).parent(this).remove();
                    $('input[value="Add more features"]').show();
                    j++;
                }
            });
        }
        else {
            alert("Maximum 20 extra features can be added.");
            $('input[value="Add more features"]').hide();
        }
    });

    $('.buy').click(function() {
        var pid = $(this).children('input[type="hidden"]').val();
        if ($('#lg').html() == "Login") {
            $('#lg').click();
            alert('You must be login to buy.');
        }
        else {
            $.get('php/aic.php', {id: pid}, function(d) {
                if (d[0] == "a")
                {   var args = d.split(";");
                    $('.bill').html("Rs. " + args[0].substring(1));
                    $('#cart').append('<div class="col-sm-1 col-xs-1 current_product" style="width: 115px; padding-left:0px; text-align: center;"><a href="product_details.php?id=' + pid +'"><span class="label label-danger prc">Rs. ' + args[1] + '</span><img src="' + args[2] + '" height="80px" width="100px"/>' + args[3] + '</a><br><span class="badge q" title="Quantity">1</span><br> <span title="Click to increase quanity" style="cursor: pointer;" class="btn-success label pos" onclick="inc(this,' + pid + ')">+</span> <span title="Click to decrease quanity" style="cursor: pointer;" class="label btn-danger neg" onclick="dec(this,' + pid + ')">-</span> <span title="Click to remove product" style="cursor: pointer;" class="label btn-danger rem" onclick="rem(this,' + pid + ')">Remove</span></div>');
                    alert("Item added to your cart.");
                }
                else if (d == "b") {
                    alert("Item is already available in your cart.");
                }
            });
        }

    });	
    
    
    $('#ch').click(function(){
        window.location = "update_product.php?id=1";
    });
    
    
    
});

function inc(p,k){
    $.get('php/cii.php', {id: k}, function(d) {
                if (d[0] == "t")
                {   
                    var args = d.split(";");
                    $('.bill').html("Rs. " + args[0].substring(1));
                    $(p).parent().children('a').children('.prc').html("Rs. " + args[2])
                    $(p).parent().children('.q').html(args[1])
                }
                else if (d == "f") {
                    alert("Only " + $(p).parent().children('.q').html() +" quantity is available in stock.");
                }
            });
}

function dec(p,k){
  $.get('php/cid.php', {id: k}, function(d) {
                if (d[0] == "t")
                {   
                    var args = d.split(";");
                    $('.bill').html("Rs. " + args[0].substring(1));
                    $(p).parent().children('a').children('.prc').html("Rs. " + args[2])
                    $(p).parent().children('.q').html(args[1])
                }
                else if (d == "f") {
                    alert("Minimum quantity should be 1");
                }
            });
}

function rem(p,k){
  if (confirm('Are you sure, you want to remove this item?')) {
                     $.get('php/cir.php', {id: k}, function(d) {
            $('.bill').html("Rs. " + d);
            $(p).parent().remove();
        });
                }

}