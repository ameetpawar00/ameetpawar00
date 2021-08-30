var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "images/bg/1.jpg",
		        "images/bg/2.jpg",
		        "images/bg/3.jpg",
		        "images/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }
	    };

}();

var colours=['#98c8d4','#00ff00','#0000ff','#acacac'];  // List of colors
    var tempColor=0;
    var changeInterval=8000;    // Change interval in miliseconds
    var buttonId='#lockBtn';      // Object to change colours. 
    $(document).ready(function(){        
        setInterval(function(){
                $(buttonId).animate({backgroundColor: colours[tempColor]},500);
                //$('body').css({background: 'url("'+bgImage[tempBody]+'")'});
                //$(body).animate({opacity: 1.0}, 1000);
				//$(body).animate({opacity: 0.0}, 1000)

                tempColor=tempColor+1;
                if (tempColor>colours.length-1) tempColor=0;
            },changeInterval);
    });
