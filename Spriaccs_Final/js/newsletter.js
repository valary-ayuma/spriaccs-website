document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector(".newsletter-form");

    if (!form) return;

    const emailInput = form.querySelector('input[name="email"]');
    const button = form.querySelector("button");

    // Create feedback message
    const feedback = document.createElement("div");
    feedback.className = "newsletter-feedback";
    form.appendChild(feedback);

    // Create unsubscribe link
    const unsubscribeLink = document.createElement("a");
    unsubscribeLink.href = "#";
    unsubscribeLink.className = "unsubscribe-link";
    unsubscribeLink.textContent = "Click here to unsubscribe";
    unsubscribeLink.style.display = "none";

    form.appendChild(unsubscribeLink);


    function showSubscribed(){

    showSubscribed();

}

function showUnsubscribed(){

    showUnsubscribed();
}

    /*==================================
            SUBSCRIBE
    ==================================*/

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const email = emailInput.value.trim();

        if (email === "") {

            feedback.innerHTML = "Please enter your email.";

            feedback.className = "newsletter-feedback error";

            return;

        }

        button.disabled = true;

        button.innerHTML = "Subscribing...";

        const formData = new FormData();

        formData.append("email", email);

        fetch("newsletter-subscribe.php", {

            method: "POST",

            body: formData

        })

        .then(response => response.json())

        .then(data => {

            if (data.success) {

                emailInput.value ="";

                localStorage.setItem("newsletterEmail", data.email);

                showSubscribed();

                feedback.innerHTML = data.message;

                feedback.className = "newsletter-feedback success";

                button.innerHTML = "✓ Subscribed";

                button.classList.add("subscribed");

                button.disabled = true;

                unsubscribeLink.style.display = "inline-block";

            } else {

                feedback.innerHTML = data.message;

                feedback.className = "newsletter-feedback error";

                button.innerHTML = "Subscribe";

                button.disabled = false;

            }

        })

        .catch(() => {

            feedback.innerHTML = "Network error. Please try again.";

            feedback.className = "newsletter-feedback error";

            button.innerHTML = "Subscribe";

            button.disabled = false;

        });

    });

    /*==================================
            UNSUBSCRIBE
    ==================================*/

    unsubscribeLink.addEventListener("click", function (e) {

        e.preventDefault();

        const email = emailInput.value.trim();

        if (email === "") return;

        const formData = new FormData();

        formData.append("email", email);

        fetch("newsletter-unsubscribe.php", {

            method: "POST",

            body: formData

        })

        .then(response => response.json())

        .then(data => {

            if (data.success) {

                emailInput.value = "";

                localStorage.removeItem("newsletterEmail");

                showUnsubscribed();


                feedback.innerHTML = data.message;

                feedback.className = "newsletter-feedback success";

                button.innerHTML = "Subscribe";

                button.disabled = false;

                button.classList.remove("subscribed");

                unsubscribeLink.style.display = "none";

            } else {

                feedback.innerHTML = data.message;

                feedback.className = "newsletter-feedback error";

            }

        })

        .catch(() => {

            feedback.innerHTML = "Network error.";

            feedback.className = "newsletter-feedback error";

        });

    });

    /*==================================
        RESTORE SUBSCRIPTION
==================================*/

const savedEmail = localStorage.getItem("newsletterEmail");

if(savedEmail){

    emailInput.value = savedEmail;

    const formData = new FormData();

    formData.append("email", savedEmail);

    fetch("newsletter-status.php",{

        method:"POST",

        body:formData

    })

    .then(response=>response.json())

    .then(data=>{

        if(!data.success){

            localStorage.removeItem("newsletterEmail");

            return;

        }

        if(data.status==="Active"){

            showSubscribed();

            feedback.innerHTML="You're subscribed to our newsletter.";

            feedback.className="newsletter-feedback success";

        }

        else{

            localStorage.removeItem("newsletterEmail");

            showUnsubscribed();

            feedback.innerHTML="";

        }

    })

    .catch(()=>{

        console.log("Unable to verify newsletter status.");

    });

}

});