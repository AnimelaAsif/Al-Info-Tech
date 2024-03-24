document.addEventListener("DOMContentLoaded", function() {
    var overlay = document.getElementById("overlay");
    var closeButton = document.getElementById("closeOverlay");

    closeButton.addEventListener("click", function() {
        overlay.style.display = "none";
        document.body.style.overflow = "auto";
    });
    overlay.style.display = "flex";
    document.body.style.overflow = "hidden";
});
