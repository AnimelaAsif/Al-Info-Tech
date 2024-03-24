document.addEventListener("DOMContentLoaded", function() {
    // Close overlay when close button is clicked
    document.getElementById("closeOverlay").addEventListener("click", function() {
        document.getElementById("overlay").style.display = "none";
    });
});
