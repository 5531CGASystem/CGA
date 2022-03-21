<html>
<head>
<script language = "javascript">

var timerID = null;
var timerRunning = false;

//get the date when the page is load
var old=new Date();
var old_date = old.getDate(); 

function startclock() 
{
        stopclock();
        showtime();       
}
    
function stopclock() 
{
        if(timerRunning)
                clearTimeout(timerID);
        timerRunning = false;       
        
}

function showtime() 
{
	var now=new Date();
	var current_date = now.getDate();
	if(current_date != old_date){
	 	window.location.reload();
	}
	
	//check the current date every 1 second, if the date changed, reload the page to show new date
	timerID = window.setTimeout("showtime()",1000);   
        timerRunning = true;
}



function openLink($url) {

   window.open($url,"helpWindow",'menubar=no,scrollbars=yes, resizable=yes, status=no,titlebar=no,toolbar=no');

}
</script>

</head>
<body bgcolor=#33cccc onLoad="startclock()">
<style type="text/css">
a:link {color: #333366}
a:visited {color: #333366}
a:hover {background: #CCFFCC}
a {text-decoration: none}
</style>


<table border = "0" width = "100%">
<tr width = "100%">
<td width = "5%"align=left><img src="../pics/crsmgr_s.jpg" border=0></td>
<td  align=center><font size = 5><b>Course Student Menu</b></font></td>
</tr>
</table>


<table border = "0" width = "100%">
<tr width = "100%">
<td align = "left"><font color=blue>Welcome! <font color=black>LIAO, anne</font>. Today is Mar-20-2022 Sunday.</font></td>

<td align = "right">

<i><b><a href = "../welcome.php" target ="contents"><font color=black>Home</b></i></a> |</font>

<i><b><a href = "../role_list.php" target ="_top"><font color=black>Switch Access Role</b></i></a> |</font>



<i><b><a href = "../includes/logout.php" target ="_top"><font color=black>Logout</b></i></a></font><br>
</td>
</tr>
</table>
</body>
</html>
