document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("toggleButton").addEventListener("click", function() {
        var feedbackContainer = document.getElementById("feedbackContainer");
        if (feedbackContainer.style.display === "none") {
            feedbackContainer.style.display = "block";
            this.innerText = "Hide feedback";
        } else {
            feedbackContainer.style.display = "none";
            this.innerText = "Click here to see the feedback";
        }
    });
});
