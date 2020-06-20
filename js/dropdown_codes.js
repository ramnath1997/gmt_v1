


function getCourse(str) {
  if (str=="") {
    document.getElementById("Course").innerHTML="";
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
      document.getElementById("Course").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getCourse.php?q="+str,true);
  xmlhttp.send();
}



function getBranch(str) {
  if (str=="") {
    document.getElementById("Branch").innerHTML="";
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
      document.getElementById("Branch").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getBranch.php?q="+str,true);
  xmlhttp.send();
}
function getSem(str) {
  if (str=="") {
    document.getElementById("sem").innerHTML="";
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
      document.getElementById("sem").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getSem.php?q="+str,true);
  xmlhttp.send();
}

function getCourse_staff_select(str) {
  if (str=="") {
    document.getElementById("Course_staff_select").innerHTML="";
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
      document.getElementById("Course_staff_select").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getCourse.php?q="+str,true);
  xmlhttp.send();
}



function getBranch_staff_select(str) {
  if (str=="") {
    document.getElementById("Branch_staff_select").innerHTML="";
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
      document.getElementById("Branch_staff_select").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../getBranch.php?q="+str,true);
  xmlhttp.send();
}

function getSem_staff_select(str) {
  if (str=="") {
    document.getElementById("sem_staff_select").innerHTML="";
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
      document.getElementById("sem_staff_select").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getSem.php?q="+str,true);
  xmlhttp.send();
}
function getSem_princi_select(str) {
  if (str=="") {
    document.getElementById("sem_princi_select").innerHTML="";
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
      document.getElementById("sem_princi_select").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getsemP.php?q="+str,true);
  xmlhttp.send();
}
function getSem_staffSS(str) {
  if (str=="") {
    document.getElementById("sem_staffSS").innerHTML="";
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
      document.getElementById("sem_staffSS").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../getSemSS.php?q="+str,true);
  xmlhttp.send();
}

function getCourse_update(str) {
  if (str=="") {
    document.getElementById("Course_update").innerHTML="";
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
      document.getElementById("Course_update").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getCourse.php?q="+str,true);
  xmlhttp.send();
}


function getBranchBG(str) {
  if (str=="") {
    document.getElementById("BranchBG").innerHTML="";
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
      document.getElementById("BranchBG").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getBranchBG.php?q="+str,true);
  xmlhttp.send();
}
function getBranchBG_s(str) {
  if (str=="") {
    document.getElementById("BranchBG_s").innerHTML="";
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
      document.getElementById("BranchBG_s").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getBranchBG.php?q="+str,true);
  xmlhttp.send();
}
function getBranch_update(str) {
  if (str=="") {
    document.getElementById("Branch_update").innerHTML="";
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
      document.getElementById("Branch_update").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getBranch.php?q="+str,true);
  xmlhttp.send();
}
function getSem_update(str) {
  if (str=="") {
    document.getElementById("sem_update").innerHTML="";
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
      document.getElementById("sem_update").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","./getSem.php?q="+str,true);
  xmlhttp.send();
}