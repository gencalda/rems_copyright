<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<title>Recruitment &amp; Employee Performance Monitoring System</title>

		 <script type="text/javascript">
                tday  =new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

                function GetClock(){
                tzOffset = +8; 

                d = new Date();
                dx = d.toGMTString();
                dx = dx.substr(0,dx.length -3);
                d.setTime(Date.parse(dx))
                d.setHours(d.getHours() + tzOffset);
                nday   = d.getDay();
                nmonth = d.getMonth();
                ndate  = d.getDate();
                nyear = d.getYear();
                nhour  = d.getHours();
                nmin   = d.getMinutes();
                nsec   = d.getSeconds();

                if(nyear<1000) nyear=nyear+1900;

                     if(nhour ==  0) {ap = " AM";nhour = 12;}
                else if(nhour <= 11) {ap = " AM";}
                else if(nhour == 12) {ap = " PM";}
                else if(nhour >= 13) {ap = " PM";nhour -= 12;}

                if(nmin <= 9) {nmin = "0" +nmin;}
                if(nsec <= 9) {nsec = "0" +nsec;}


                document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
                setTimeout("GetClock()", 1000);
                }
                window.onload=GetClock;
//-->  
                
			</script>
            <?php

                $token = $_GET['token'];

                if($token == md5('home') || $token == md5('about') || $token == md5('newsandinformation') || $token == md5('jobopportunities'))
                {
                    include_once 'link.php';
                }
				else if($token == md5('contact') || $token == md5('application') || $token == md5('register') || $token == md5('login') || $token == md5('index'))
				{
					 include_once 'link.php';
				}
                else if($token ==  md5('image') || $token == md5('pdf') || $token == md5('terms') || $token == md5('failed'))
                {
                    include_once 'link.php';
                }
                else
                {
                	include_once 'linkTwo.php';
                }

            ?>
	
<!--[if lt IE 9]><script src="js/respond.min.js"></script><![endif]-->
<!--[if gte IE 9]>
<style type="text/css">
    .gradient {filter: none !important;}
</style>
<![endif]-->

	</head>

	<body >
		<div class='container-fluid heading' >
			<div class='time'>
				<div id="clockbox"></div>
			</div>
		</div>
			

		
