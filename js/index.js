const formLogin = document.querySelector("#formLogin")
btnLogin.addEventListener('click', event => {
  event.preventDefault()
  if (username.value == "" || pass.value == "") {
    alert("Completa todos los campos...")
    return false
  }
  const form = new FormData(formLogin)
  form.append("function", "login")
  fetch("data/Users.php", {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(json => {
      if (!json) {
        alert("No has podido iniciar sesión")
        return false
      }
      sessionStorage.setItem("user", JSON.stringify(json))
      location.href = "profile.php"
    })
})

showRegister.addEventListener("click", event => {
  event.preventDefault()
  if (register.style.display == "" || register.style.display == "none") {
    register.style.display = "block"
    formLogin.style.display = "none"
  }
})
hideRegister.addEventListener("click", event => {
  event.preventDefault()
  if (register.style.display == "block") {
    register.style.display = "none"
    formLogin.style.display = "block"
  }
})

btnRegister.addEventListener("click", event => {
  event.preventDefault()
  if (nameRegister.value == "" ||
    phoneRegister.value == "" ||
    emailRegister.value == "" ||
    passwordRegister.value == "") {
    alert("Completa todos los campos")
    return false
  }
  const form = new FormData()
  form.append("function", "createUser")
  form.append("name", nameRegister.value)
  form.append("phone", phoneRegister.value)
  form.append("email", emailRegister.value)
  form.append("password", passwordRegister.value)

  fetch("data/Users.php", {
    method: "POST",
    body: form
  }).then(response => response.json())
    .then(json => {
      alert(json.text)
      if (json.status == "success") {
        hideRegister.click()
      }
    })
})