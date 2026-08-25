const slides = document.querySelectorAll(".slide");

let current = 0;

function nextSlide(){

    slides[current].classList.remove("active");

    current++;

    if(current >= slides.length){

        current = 0;

    }

    slides[current].classList.add("active");

}

/*
3000 milliseconds = 3 seconds
*/

setInterval(nextSlide,3000);