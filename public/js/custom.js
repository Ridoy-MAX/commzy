document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("reviewForm");
    const ratingInputs = document.querySelectorAll("input[name='rating']");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        // Get selected rating
        let selectedRating = null;
        for (const input of ratingInputs) {
            if (input.checked) {
                selectedRating = input.value;
                break;
            }
        }

        // Get other form values
        const comment = form.querySelector("textarea[name='comment']").value;
        const name = form.querySelector("input[name='name']").value;
        const email = form.querySelector("input[name='email']").value;
        const saveInfo = form.querySelector("input[name='saveInfo']").checked;

        // You can now send this data to your server or perform any desired action
        console.log("Rating: " + selectedRating);
        console.log("Comment: " + comment);
        console.log("Name: " + name);
        console.log("Email: " + email);
        console.log("Save Info: " + saveInfo);

        // Reset the form
        form.reset();
    });
});
