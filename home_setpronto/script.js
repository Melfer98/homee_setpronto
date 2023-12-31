
        document.addEventListener("DOMContentLoaded", function () {
            var welcomeOverlay = document.getElementById("welcome-overlay");
            var modalContainer = document.getElementById("modal-container");

            welcomeOverlay.style.display = "flex";

            setTimeout(function () {
                welcomeOverlay.style.display = "none";
                modalContainer.style.display = "flex";
            }, 6000);
        });

        function openModal() {
            document.getElementById("modal-container").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal-container").style.display = "none";
        }
        