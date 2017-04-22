var host = window.location.host;
var proto = window.location.protocol;

if(host == "localhost"){
	var ajax_url = proto+"//"+host+"/scavenger/";	
}else if(host == "flexsin.org"){
	var ajax_url = proto+"//"+host+"/lab/scavenger/";	
}

/*----Start of Menu-----*/
$(document).ready(function() {
	$(".mobMenu").click(function() {
		$("#menu").slideToggle();
		$(this).toggleClass('active');
	});
});

/*----Start of Menu-----*/
$(document).ready(function() {	
	$(".termmobmenu").click(function() {
		$("#termmenu").slideToggle();
	});
});



/*---------------Start of Lang inner page ------------*/
$(document).ready(function() {
	$(".about-langdrop").click(function() {
	$(".about-langlist-drop").slideToggle();
	});	
	/*-----------------dash right toggle------------*/
	$(".settingIcon").click(function(){
		$(".settingBx").slideToggle();								 
	})
});
/* --------------------IMAGE PREVIEW--------------------*/
$(document).ready(function() {
$(".fileupload").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $(".dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:100px;width: 100px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
  });
/* -------------------- Custom --------------------*/
setTimeout(function() {
    $('.message-green').fadeOut();
}, 3000);

setTimeout(function() {
    $('.message-red').fadeOut();
}, 3000);
 




