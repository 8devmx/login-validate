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