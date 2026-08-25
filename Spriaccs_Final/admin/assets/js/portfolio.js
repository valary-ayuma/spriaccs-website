document.addEventListener("DOMContentLoaded", function () {

    const category = document.getElementById("category");
    const websiteField = document.getElementById("websiteField");
    const projectLink = document.getElementById("projectLink");

    function toggleWebsiteField() {

        if (category.value === "Website Design") {

            websiteField.style.display = "block";
            projectLink.required = true;

        } else {

            websiteField.style.display = "none";
            projectLink.required = false;
            projectLink.value = "";

        }

    }

    toggleWebsiteField();

    category.addEventListener("change", toggleWebsiteField);

});