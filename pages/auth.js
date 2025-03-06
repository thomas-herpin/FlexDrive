document.addEventListener("DOMContentLoaded", function () {
    const signUpForm = document.querySelector("#signUpForm");
    const signInForm = document.querySelector("#signInForm");

    if (signUpForm) {
        signUpForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const firstName = document.querySelector("#firstName").value;
            const lastName = document.querySelector("#lastName").value;
            const email = document.querySelector("#signUpEmail").value;
            const password = document.querySelector("#signUpPassword").value;

            if (email && password.length >= 8) {
                localStorage.setItem("user", JSON.stringify({ firstName, lastName, email, password, role: "user" }));
                alert("Pendaftaran berhasil! Silakan login.");
                window.location.href = "sign_in.html";
            } else {
                alert("Pastikan semua data telah diisi dan password minimal 8 karakter.");
            }
        });
    }

    if (signInForm) {
        signInForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const email = document.querySelector("#signInEmail").value;
            const password = document.querySelector("#signInPassword").value;
            const storedUser = JSON.parse(localStorage.getItem("user"));

            const adminEmail = "thomas@admin.com";
            const adminPassword = "admin123";

            if (email === adminEmail && password === adminPassword) {
                alert("Login berhasil! Selamat datang, Admin.");
                window.location.href = "admin/home admin.html";
            } else if (storedUser && storedUser.email === email && storedUser.password === password) {
                alert("Login berhasil! Selamat datang, " + storedUser.firstName);
                window.location.href = "user/home_user.html";
            } else {
                alert("Email atau password salah.");
            }
        });
    }
});
