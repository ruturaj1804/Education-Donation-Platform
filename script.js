document.getElementById("scholarshipForm").addEventListener("submit", function(event) {
    let phone = document.getElementById("phone").value;
    if (phone.length !== 10 || isNaN(phone)) {
        alert("Phone number must be 10 digits.");
        event.preventDefault();
    }
});
