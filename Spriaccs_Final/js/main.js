/*==================================================
SPRIACCS WEBSITE
Main JavaScript
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*====================================
        ELEMENTS
    ====================================*/

    const header = document.querySelector("header");
    const menuBtn = document.querySelector(".menu-btn");
    const navLinks = document.querySelector(".nav-links");
    const navItems = document.querySelectorAll(".nav-links a");

    /*====================================
        MOBILE MENU
    ====================================*/

    if (menuBtn) {

        menuBtn.addEventListener("click", () => {

            navLinks.classList.toggle("active");

            menuBtn.textContent =
                navLinks.classList.contains("active")
                    ? "✕"
                    : "☰";

        });

    }

    navItems.forEach(link => {

        link.addEventListener("click", () => {

            navLinks.classList.remove("active");

            menuBtn.textContent = "☰";

        });

    });

    /*====================================
        STICKY NAVBAR
    ====================================*/

    function navbarScroll() {

        if (window.scrollY > 30) {

            header.classList.add("scrolled");

        } else {

            header.classList.remove("scrolled");

        }

    }

    navbarScroll();

    window.addEventListener("scroll", navbarScroll);

    /*====================================
        SMOOTH SCROLL
    ====================================*/

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {

        anchor.addEventListener("click", function (e) {

            e.preventDefault();

            const target = document.querySelector(this.getAttribute("href"));

            if (target) {

                target.scrollIntoView({

                    behavior: "smooth"

                });

            }

        });

    });

    /*====================================
        SCROLL REVEAL
    ====================================*/

    const revealElements = document.querySelectorAll(

        ".service-card, .project, .stats div, .testimonial-grid article, .section-heading"

    );

    const reveal = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {

                entry.target.classList.add("show");

            }

        });

    }, {

        threshold: 0.15

    });

    revealElements.forEach(el => {

        el.classList.add("fade-up");

        reveal.observe(el);

    });

    /*====================================
        ACTIVE NAVIGATION
    ====================================*/

    const sections = document.querySelectorAll("section");

    window.addEventListener("scroll", () => {

        let current = "";

        sections.forEach(section => {

            const sectionTop = section.offsetTop - 150;

            if (scrollY >= sectionTop) {

                current = section.getAttribute("class");

            }

        });

        navItems.forEach(link => {

            link.classList.remove("active");

            if (link.getAttribute("href").includes(current)) {

                link.classList.add("active");

            }

        });

    });

    /*====================================
        NUMBER COUNTER
    ====================================*/

    const counters = document.querySelectorAll(".stats h3");

    const counterObserver = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {

                const counter = entry.target;

                const text = counter.textContent;

                const target = parseInt(text.replace(/\D/g, ""));

                const suffix = text.replace(/[0-9]/g, "");

                let value = 0;

                const speed = target / 80;

                const update = () => {

                    value += speed;

                    if (value < target) {

                        counter.textContent = Math.floor(value) + suffix;

                        requestAnimationFrame(update);

                    } else {

                        counter.textContent = target + suffix;

                    }

                };

                update();

                counterObserver.unobserve(counter);

            }

        });

    });

    counters.forEach(counter => {

        counterObserver.observe(counter);

    });

    /*====================================
        BUTTON RIPPLE
    ====================================*/

    document.querySelectorAll(".btn").forEach(button => {

        button.addEventListener("click", function (e) {

            const ripple = document.createElement("span");

            ripple.classList.add("ripple");

            const rect = this.getBoundingClientRect();

            ripple.style.left = `${e.clientX - rect.left}px`;

            ripple.style.top = `${e.clientY - rect.top}px`;

            this.appendChild(ripple);

            setTimeout(() => {

                ripple.remove();

            }, 600);

        });

    });

    /*====================================
        BACK TO TOP BUTTON
    ====================================*/

    const topButton = document.createElement("button");

    topButton.innerHTML = "↑";

    topButton.className = "back-to-top";

    document.body.appendChild(topButton);

    topButton.addEventListener("click", () => {

        window.scrollTo({

            top: 0,

            behavior: "smooth"

        });

    });

    window.addEventListener("scroll", () => {

        if (window.scrollY > 600) {

            topButton.classList.add("show");

        } else {

            topButton.classList.remove("show");

        }

    });

});