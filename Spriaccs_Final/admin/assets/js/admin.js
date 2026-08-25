// Current Date

const currentDate = document.getElementById("currentDate");

const today = new Date();

currentDate.innerHTML = today.toLocaleDateString("en-US",{
    weekday:"short",
    day:"numeric",
    month:"short",
    year:"numeric"
});

// Sidebar Toggle

const menuToggle = document.getElementById("menuToggle");

const sidebar = document.querySelector(".sidebar");

const mainContent = document.querySelector(".main-content");

menuToggle.addEventListener("click",()=>{

    sidebar.classList.toggle("collapsed");

    mainContent.classList.toggle("expanded");

});

