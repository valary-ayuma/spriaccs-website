
/* Live description counter */

const description = document.getElementById("description");
const counter = document.getElementById("counter");

if(description){

    description.addEventListener("input",function(){

        counter.innerHTML = this.value.length + " / 250 characters";

    });

}

const icons = document.querySelectorAll(".icon-gallery i");

const iconInput = document.getElementById("icon");

const preview = document.getElementById("previewIcon");

const selectedText = document.getElementById("selectedText");

icons.forEach(icon=>{

    icon.addEventListener("click",()=>{

        icons.forEach(i=>i.classList.remove("active"));

        icon.classList.add("active");

        iconInput.value = icon.className.replace(" active","");

        preview.className = icon.className.replace(" active","");

        selectedText.innerHTML = icon.dataset.name;

    });

});
const search = document.getElementById("serviceSearch");

if(search){

    search.addEventListener("keyup", function(){

        const value = this.value.toLowerCase();

        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row){

            row.style.display = row.innerText.toLowerCase().includes(value)
                ? ""
                : "none";

        });

    });

}