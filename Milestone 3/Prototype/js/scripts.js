/*!
* Start Bootstrap - Blog Home v5.0.6 (https://startbootstrap.com/template/blog-home)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-blog-home/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

//responsive search
function showResult(str) {
    if (str.length==0) {
      document.getElementById("responsivesearch").innerHTML="";
      document.getElementById("responsivesearch").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("responsivesearch").innerHTML=this.responseText;
        document.getElementById("responsivesearch").style.border="1px solid #A5ACB2";
        console.alert("aaaa");
      }
    }
    xmlhttp.open("GET","responsivesearch.php?q="+str,true);
    xmlhttp.send();
  }