if(document.cookie.indexOf('login=1') != -1){
    document.getElementById("navbtn").onclick = "location.href='newlist.php'";
    document.getElementById("navbtn").innerText = "Create New";
}