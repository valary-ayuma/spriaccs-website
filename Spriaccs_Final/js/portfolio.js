/*==================================
    PORTFOLIO FILTER
==================================*/

document.addEventListener("DOMContentLoaded", () => {

    const filterButtons = document.querySelectorAll(".filter-btn");
    const projects = document.querySelectorAll(".project");

    filterButtons.forEach(button => {

        button.addEventListener("click", () => {

            // Remove active class
            filterButtons.forEach(btn => btn.classList.remove("active"));

            // Add active class to clicked button
            button.classList.add("active");

            const filter = button.getAttribute("data-filter");

            projects.forEach(project => {

                const category = project.getAttribute("data-category");

                if (filter === "all" || category === filter) {

                    project.style.display = "block";

                    setTimeout(() => {

                        project.style.opacity = "1";
                        project.style.transform = "scale(1)";

                    }, 100);

                } else {

                    project.style.opacity = "0";
                    project.style.transform = "scale(0.95)";

                    setTimeout(() => {

                        project.style.display = "none";

                    }, 250);

                }

            });

        });

    });

});