/* Set the width of the side navigation to 250px */
function triggerMenu() {
	if($('#mySidenav').hasClass('menu-active'))
	{
    	document.getElementById("mySidenav").style.left = "-250px";
    	document.getElementById("mySidenav").style.opacity = "0";
	    document.getElementById("openMenu").style.left = "0";
        document.getElementById("body").style.opacity = "1";
        document.body.style.background = "#fff";
	    $('#mySidenav').removeClass('menu-active');
    }
    else
    {
    	document.getElementById("mySidenav").style.left = "0px";
    	document.getElementById("mySidenav").style.opacity = "1";
    	document.getElementById("openMenu").style.left = "250px";
        document.getElementById("body").style.opacity = "0.5";
	    $('#mySidenav').addClass('menu-active');
	}
}
