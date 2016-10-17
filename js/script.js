/* Set the width of the side navigation to 250px */
function triggerMenu() {
	if($('#mySidenav').hasClass('menu-active'))
	{
        
    	$('#menu-button').show();
        $('.menu-text').hide();
        document.getElementById("mySidenav").style.width = "40px";
    	document.getElementById("mySidenav").style.opacity = "1";
        document.getElementById("mySidenav").style.paddingTop = "10px";
	    
        document.getElementById("body").style.opacity = "1";
        $('.closebtn').hide();
        
        document.body.style.background = "#fff";
	    $('#mySidenav').removeClass('menu-active');
    }
    else
    {   
        $('.menu-text').show();
        $('#menu-button').hide();
     
    	document.getElementById("mySidenav").style.width = "240px";
    	document.getElementById("mySidenav").style.opacity = "1";
        document.getElementById("mySidenav").style.paddingTop = "50px";
    	$('.closebtn').show();
        
        document.getElementById("body").style.opacity = "0.5";
	    $('#mySidenav').addClass('menu-active');
	}
}
