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
  
        const formData = new FormData();
        formData.append("firstName", firstName);
        formData.append("lastName", lastName);
        formData.append("email", email);
        formData.append("password", password);
  
        fetch("sign_up.php", {
          method: "POST",
          body: formData
        })
        .then(response => response.text())
        .then(result => {
          if (result === "success") {
            alert("Registrasi berhasil! Mohon untuk login.");
            window.location.href = "sign_in.html";
          } else {
            alert("Registrasi gagal: " + result);
          }
        });
      });
    }
  
    if (signInForm) {
      signInForm.addEventListener("submit", function (event) {
        event.preventDefault();
  
        const email = document.querySelector("#signInEmail").value;
        const password = document.querySelector("#signInPassword").value;
  
        const formData = new FormData();
        formData.append("email", email);
        formData.append("password", password);
  
        fetch("sign_in.php", {
          method: "POST",
          body: formData
        })
        .then(response => response.text())
        .then(result => {
          if (result === "admin_success") {
            alert("Login berhasil! Selamat datang, admin.");
            window.location.href = "admin/home_admin.php"; 
          } else if (result === "user_success") {
            alert("Login berhasil! Selamat datang.");
            window.location.href = "user/home_user.php"; 
          } else if (result === "wrong_password") {
            alert("Password salah.");
          } else if (result === "user_not_found") {
            alert("User tidak ditemukan.");
          } else {
            alert("Login gagal: " + result);
          }
        })        
      });
    }
  });