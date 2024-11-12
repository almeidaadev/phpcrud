const btnEdit = document.querySelectorAll(".edit-btn");
const modal = document.querySelector("#modal");

modal.style.display = "none";

btnEdit.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.preventDefault();
        const editNome = document.querySelector("#editNome");
        const editEmail = document.querySelector("#editEmail");
        const editTelefone = document.querySelector("#editTelefone");
        const editID = document.querySelector("#editId");

        modal.style.display = "flex";

        const id = this.dataset.id;

        fetch(`get.php?id=${id}`, {
            method: "GET",
        })
            .then((res) => res.json())
            .then((data) => {
                const { id, nome, email, telefone } = data;

                editID.value = id;
                editNome.value = nome;
                editEmail.value = email;
                editTelefone.value = telefone;
            });

        const closeModal = document.querySelector(".modal__close");

        closeModal.addEventListener("click", function (e) {
            e.preventDefault();
            this.parentNode.parentNode.style.display = "none";
        });
    });
});

const editForm = document.querySelector("#editForm");

editForm.addEventListener("submit", (e) => {
    e.preventDefault();

    // const data = new FormData(e.target);

    fetch("update.php", {
      method: "POST",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      // data,
    })
        .then((resJson) => resJson.json())
        .then((data) => console.log(data));
});




// const updatePromisse = async () => {
//     const url = "update.php";
//
//     const response = await fetch(url, {
//         method: "POST",
//         headers: {
//             Accept: "application/json",
//             "Content-Type": "application/json",
//         },
//     });
//     const data = response;
//     console.log(data);
// };
// updatePromisse();
