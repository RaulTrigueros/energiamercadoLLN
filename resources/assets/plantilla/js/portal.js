try {
    let log = document.getElementById("variable").value;
    let link = document.getElementById("linkL");


    if (log == 'si') {
        link.innerHTML = "Dashboard";
        link.href = "/main";
    }
} catch (error) {
    //console.log(error);
}


