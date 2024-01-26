
setInterval(() => {
}, 2000)
function getMessage(){
    var xml = new XMLHttpRequest();

    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var uic = document.getElementById("messages")
            uic.innerHTML= this.responseText;
        }
        xml.open("GET" , "messaging.php?q=" + true);
        xml.send();
    };
}
