<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type']!="20") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    ?>
<form method="post">
<input type="textarea" name="qq" value="" onblur="run(this.value);">
<script type="text/javascript">
                                    	
 function run(str) {
  if (str=="") {
    document.getElementById("result").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("result").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./result.php?q="+str,true);
  xmlhttp.send();
}
</script>    
<div id="result"></div> 
</form>