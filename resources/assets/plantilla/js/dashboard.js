try {
    let divAdmin = document.getElementById("nav-admin");
    let admin = document.getElementById("rol-admin").value;
    if (admin != 1) {
        divAdmin.remove();
    }
} catch (error) {
    //console.log(error);
}