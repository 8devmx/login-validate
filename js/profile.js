if (!sessionStorage.getItem("user")) {
  location.href = "index.html"
}
const user = JSON.parse(sessionStorage.getItem("user"))
username.innerText = user.username
rol.innerText = user.rol
avatar.setAttribute("src", user.avatar)

btnUpdate.addEventListener('click', event => {
  event.preventDefault()
  updateProfile.style.display = "block"
  usernameInput.value = user.username
  rolInput.value = user.rol_id
})
updateData.addEventListener('click', event => {
  event.preventDefault()
  const form = new FormData(updateProfile)
  form.append("function", "updateProfile")
  form.append("id", user.id)
  fetch("data/Users.php", {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(json => {
      alert(json.text)
    })
})

avatar.addEventListener('click', () => changeAvatar.click())

changeAvatar.addEventListener('change', (files) => {
  const fileUpload = files.target.files[0]
  const form = new FormData()
  form.append("file", fileUpload)
  form.append("function", "setAvatar")
  fetch("data/Users.php",
    {
      method: "POST",
      body: form
    }).then(response => response.json())
    .then(json => {
      if (json.status === "success") {
        avatar.setAttribute("src", "public/" + json.file)
      }
      alert(json.text)
    })
})

logout.addEventListener("click", event => {
  event.preventDefault()
  const confirmation = confirm("Deseas cerrar sesión")
  if (confirmation) {
    sessionStorage.removeItem("user")
    location.href = "./"
  }
})