"use strict";

//Confirm delete
window.confirmDelete = function (dataType, dataId) {
    if (dataType !== '' && dataId !== '') {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan menghapus data ini?',
            icon: "warning",
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus sekarang'
        })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    const actionURL = `/${dataType}/${dataId}`;

                    const body = document.querySelector("body");

                    //Form Delete
                    const form = document.createElement("form");
                    form.setAttribute("method", "POST");
                    form.setAttribute("action", actionURL);

                    //Input Method
                    const inputMethod = document.createElement("input");
                    inputMethod.setAttribute("type", "hidden");
                    inputMethod.setAttribute("name", "_method");
                    inputMethod.setAttribute("value", "DELETE");

                    //Input Token
                    const inputToken = document.createElement("input");
                    const token = document.querySelector("meta[name=csrf-token]").getAttribute('content')
                    inputToken.setAttribute("type", "hidden");
                    inputToken.setAttribute("name", "_token");
                    inputToken.setAttribute("value", token);

                    const br = document.createElement("br");

                    form.appendChild(inputToken)
                    form.appendChild(br.cloneNode());
                    form.appendChild(inputMethod);

                    form.setAttribute('action', actionURL);

                    body.appendChild(form);
                    form.submit();
                }
            });
    }
}

window.confirmLogout = function () {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin akan keluar dari aplikasi?',
        icon: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: 'Batal',
    }).then((confirm) => {
        if (confirm.isConfirmed) {
            const body = document.querySelector("body");
            const actionURL = `/logout`;

            //Form logout
            const form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", actionURL);

            const inputToken = document.createElement("input");
            const token = document.querySelector("meta[name=csrf-token]").getAttribute('content');
            inputToken.setAttribute("type", "hidden");
            inputToken.setAttribute("name", "_token");
            inputToken.setAttribute("value", token);

            const inputMethod = document.createElement("input");
            inputMethod.setAttribute("type", "hidden");
            inputMethod.setAttribute("name", "_method");
            inputMethod.setAttribute("value", "POST");

            form.appendChild(inputToken);
            form.appendChild(inputMethod)

            form.setAttribute('action', actionURL);
            body.appendChild(form);
            form.submit();
        }
    });
}

window.showFormCustomer = function (id = '', name = '', phone = '') {
    const inputName = document.querySelector('#customer-name');
    const inputPhone = document.querySelector('#customer-phone');
    const formCustomer = document.querySelector('#form-customer');
    const inputMethod = document.querySelector('#form-customer input[name=_method]');
    let actionURL = '/customers';

    $("#modal-form-customer").on('show.bs.modal', function() {
        inputName.classList.remove('is-invalid');
        inputPhone.classList.remove('is-invalid');
        document.querySelectorAll('span.invalid-feedback').forEach((el) => el.remove());
    });

    if(name !== '' && id !== '') {
        //Do edit
        inputName.value = name;
        inputPhone.value = phone;
        actionURL += `/${id}`;
        inputMethod.value = 'PUT';
    } else {
        // Do create
        inputName.value = '';
        inputPhone.value = '';
        inputMethod.value = 'POST';
    }

    formCustomer.setAttribute('action', actionURL);
    $("#modal-form-customer").modal('show');
}
