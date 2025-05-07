const profilePicInput = document.getElementById('profile-pic');
        const avatarPreview = document.getElementById('avatar-preview');

        profilePicInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });//imagem do perfil

        const form = document.querySelector("form"); 
//modais de confirmação
  const modalUpdate = document.getElementById("modalUpdate");
  const modalDelete = document.getElementById("modalDelete");

  document.getElementById("openUpdateModal").onclick = () => modalUpdate.style.display = "flex";
  document.getElementById("openDeleteModal").onclick = () => modalDelete.style.display = "flex";

  document.querySelectorAll(".modal-close").forEach(btn => {
    btn.onclick = () => {
      modalUpdate.style.display = "none";
      modalDelete.style.display = "none";
    };
  });

  // Confirmar atualização → envia o formulário
  document.getElementById("confirmUpdate").onclick = () => {
    modalUpdate.style.display = "none";
    form.submit(); // envia via POST para o action do <form>
  };

  // Confirmar exclusão → redireciona ou envia outro formulário
  document.getElementById("confirmDelete").onclick = () => {
    modalDelete.style.display = "none";
    document.getElementById("deleteForm").submit(); // Envia o POST corretamente
  };
  

