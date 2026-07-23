function viewCustomer(id) {
    window.location.href = BASE_URL + "/" + id;
}

function editCustomer(id) {
    window.location.href = BASE_URL + "/" + id + "/edit";
}

function deleteCustomer(id) {
    if (!confirm("Apakah Anda yakin ingin menghapus pelanggan ini?")) {
        return;
    }

    const form = document.createElement("form");

    form.method = "POST";
    form.action = BASE_URL + "/" + id;

    const token = document.createElement("input");
    token.type = "hidden";
    token.name = "_token";
    token.value = CSRF_TOKEN;

    const method = document.createElement("input");
    method.type = "hidden";
    method.name = "_method";
    method.value = "DELETE";

    form.appendChild(token);
    form.appendChild(method);

    document.body.appendChild(form);

    form.submit();
}

document.addEventListener("DOMContentLoaded", function () {

    const alertBox = document.querySelector(".success");

    if (alertBox) {
        setTimeout(function () {

            alertBox.style.transition = "0.4s";
            alertBox.style.opacity = "0";
            alertBox.style.transform = "translateY(-10px)";

            setTimeout(function () {
                alertBox.remove();
            }, 400);

        }, 3000);
    }

    document.querySelectorAll("tbody tr").forEach(function (row) {
        row.addEventListener("mouseenter", function () {
            this.style.transition = "0.2s";
        });
    });

    document.querySelectorAll(".btn-primary").forEach(function (button) {
        button.addEventListener("click", function () {
            if (this.getAttribute("href")) {
                this.innerHTML = '<i class="bi bi-arrow-repeat"></i> Memuat...';
            }
        });
    });

    document.querySelectorAll(".btn-view").forEach(function (btn) {
        btn.title = "Lihat Detail";
    });

    document.querySelectorAll(".btn-edit").forEach(function (btn) {
        btn.title = "Edit Data";
    });

    document.querySelectorAll(".btn-delete").forEach(function (btn) {
        btn.title = "Hapus Data";
    });

});