<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script>

var colours=['#ff0000','#00ff00','#0000ff','#acacac'];  // List of colors
var bgImage=['../images/bg/1.jpg','../images/bg/2.jpg','../images/bg/3.jpg','../images/bg/4.jpg'];  // List of Images


    var tempColor=0;
    var tempBody=0;
    var changeInterval=2000;    // Change interval in miliseconds
    var buttonId='#Myid';      // Object to change colours. 
    var body = "#myBody";
    $(document).ready(function(){        
        setInterval(function(){
                $(buttonId).animate({backgroundColor: colours[tempColor]},500);
                // $(body).animate({'backgroundImage': bgImage[tempBody]},500);
               //.animate({opacity: 1},{duration:1000});
               $(body).css('background-image','../images/bg/1.jpg');
                
				

                tempColor=tempColor+1;
                tempBody = tempBody+1;
                if (tempColor>colours.length-1) tempColor=0;
             //   if (tempBody>colours.length-1) tempBody=0;
            },changeInterval);
    });
</script>
</head>

<body >
<div id="myBody" style="width:100%;height:width:100%">
<div id="Myid">Pranay</div>
</div>
</body>

</html>
