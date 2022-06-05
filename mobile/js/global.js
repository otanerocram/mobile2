function lg(msg){
    root.console.log("%cLog: " + "%c"+msg, "color:#BF04A5", "color:#3276b1");
};

function doAnimation(codDiv, animation) {
	// Requiere animatecss.com
    $(codDiv).removeClass(function(){
    	return $( this ).prev().attr("class")
    }).addClass('animated '+ animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    	//toLog("doAnimation: " + codDiv + "," + animation);
    	if (animation === "bounceOut"){
    		$(codDiv).hide();
    	}
    	$(codDiv).removeClass('animated ' + animation);
    });
};
