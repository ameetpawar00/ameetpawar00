<input name="Text1" type="text" id="forHash" value="0" style="display:none"/>
<input name="Text1" type="text" id="myName" value="TRPL" style="display:none"/>
<input name="Text1" type="text" id="myId" value="1" style="display:none" />
<input name="Text1" type="text" id="myPic" value="" style="display:none" />
<input name="Text1" type="text" id="t1" value="0" style="display:none"/>
<input name="Text1" type="text" id="t2" value="Human Resources Management System By TRPL" style="display:none" />
<input name="Text1" type="text" id="title1" value="" style="display:none" />
<input name="Text1" type="text" id="title2" value="" style="display:none" />
<input name="Text1" type="text" id="currT" value="0" style="display:none" />
<input name="Text1" type="text" id="rand" value="0" style="display:none" />

<div class="loadNone" id="loading" style="display:none;background: #ffffffe6;width: 100%;height: 100%;position: fixed;z-index: 999999999999999;">
<!--<div class="loading">
<img src="images/loading/10.gif" style="vertical-align:middle" alt="" height="120">
</div>-->

    <style>
        .use-notifier #logo-doodle-notifier {
            background: transparent;
            border: 0;
            cursor: pointer;
            display: inline-block;
            height: 75px;
            left: calc(50% + 0px);
            padding: 0;
            position: absolute;
            top: calc(35% + 0px);
            width: 75px;
        }
        @keyframes anim-pos {
            0% { transform: translate(-98%, 0); }
            100% { transform: translate(98%, 0); }
        }
        @keyframes anim-z-order {
            0% { z-index: 100; }
            100% { z-index: 1; }
        }
        .use-notifier #logo-doodle-notifier .outer {
            animation: anim-z-order 3520ms linear infinite;
            height: 37.5%;
            left: 50%;
            margin-inline-start: -18.75%;
            margin-top: -18.75%;
            position: absolute;
            top: 50%;
            width: 37.5%;
        }
        .use-notifier #logo-doodle-notifier .inner {
            animation: anim-pos 880ms cubic-bezier(0.445, 0.05, 0.55, 0.95)
            infinite alternate;
            border-radius: 50%;
            height: 100%;
            position: absolute;
            transform: rotate(90deg);
            width: 100%;
        }
        .use-notifier #logo-doodle-notifier .ball0 {
            animation-delay: 2640ms;
            transform: rotate(45deg);
        }
        .use-notifier #logo-doodle-notifier .ball1 {
            animation-delay: 1760ms;
            transform: rotate(135deg);
        }
        .use-notifier #logo-doodle-notifier .ball2 {
            transform: rotate(225deg);
        }
        .use-notifier #logo-doodle-notifier .ball3 {
            animation-delay: 880ms;
            transform: rotate(315deg);
        }
        .use-notifier #logo-doodle-notifier .ball0 .inner {
            background: linear-gradient(
                    315deg, rgb(0, 85, 221), rgb(0, 119, 255), rgb(0, 119, 255));
        }
        .use-notifier #logo-doodle-notifier .ball1 .inner {
            background: linear-gradient(
                    225deg, rgb(221, 0, 0), rgb(238, 51, 51), rgb(255, 119, 85));
        }
        .use-notifier #logo-doodle-notifier .ball2 .inner {
            background: linear-gradient(
                    90deg, rgb(0, 119, 68), rgb(0, 153, 68), rgb(85, 187, 85));
        }
        .use-notifier #logo-doodle-notifier .ball3 .inner {
            background: linear-gradient(
                    0deg, rgb(255, 170, 51), rgb(255, 204, 0), rgb(255, 221, 102));
        }
    </style>

    <div class="use-notifier">
        <button id="logo-doodle-notifier" title="Click to view today’s doodle">
            <div class="outer ball0"><div class="inner"></div></div>
            <div class="outer ball1"><div class="inner"></div></div>
            <div class="outer ball2"><div class="inner"></div></div>
            <div class="outer ball3"><div class="inner"></div></div>
        </button>
    </div>
</div>
<div class="resultBox" id="sucessResult">
<center>
Data SuccessFully Updated
</center>
</div>

<div id="upperTop554"></div>
<div id="SuccessBox" class="SuccessBox"> 

	<span id="SuccessText"></span>&nbsp;&nbsp;<span onclick="ToggleBox('SuccessBox','none','')" style="vertical-align:top;cursor:pointer">x</span>  
</div> 
<div id="BigBox" class="DetailBox"> 
</div> 
 
 
<div id="WarningBox" class="WarningBox"> 
	<div id="WarningSmallBox"> 
		<div class="errorhead"> 
			<img src="img/caution.png" style="vertical-align:top"/>&nbsp; 
			Alert
			<div id="close" onclick="ToggleBox('WarningBox','none','')"> 
			</div> 
		</div> 
		<div id="WarningText"> 
			</div> 
		<br /> 
		<input class="button" id="negetive" name="Button1" onclick="ToggleBox('WarningBox','none','')" type="button" value="Ok" /><br /> 
		<br /> 
	</div> 
</div> 
 
<div id="DeleteBox" class="WarningBox"> 
	<div id="WarningSmallBox"> 
		<div class="errorhead"> 
			<img src="images/caution.png" style="vertical-align:top"/>&nbsp; 
			Alert
			<div id="close" onclick="ToggleBox('DeleteBox','none','')"> 
			</div> 
		</div> 
		<div id="DeleteText" style="color:maroon"> <br/><br/>
		Are You Sure You Want To Delete This Entry
			</div> 
		<br /> 
		<div id="DeleteButtons"> 
		
		</div> 
		<br /> 
	</div> 
</div> 
<div id="bigMoodle" class="bigMoodle">
<center>
<div id="moodle" class="moodle">
<div  class="close"  onclick="closeMoodle()"></div>
<div id="viewmoodleContent"></div>
<div id="manipulatemoodleContent"></div>
</div>
</center>
</div>


<div id="Supermoodle" class="Supermoodle">
</div>
