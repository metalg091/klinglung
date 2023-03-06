function change(){
    if(document.cookie.indexOf('login=1') != -1){
        location.href='newlist.php';
    } else{
        location.href='login.php';
    }
}
if(document.cookie.indexOf('login=1') != -1){
    document.getElementById("navbtn").innerText = "Create New";
}