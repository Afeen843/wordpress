

let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log("ajx is working")
    }
};

xhttp.open("GET", "admin.php", true);
xhttp.send();







