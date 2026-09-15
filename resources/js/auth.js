document.addEventListener('DOMContentLoaded', function () {

    // Toggle Show / Hide Password
    document.querySelectorAll('.toggle-password').forEach(function (button) {

        button.addEventListener('click', function () {

            const input = this.closest('.input-group').querySelector('input');

            const icon = this.querySelector('i');

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('bi-eye');

                icon.classList.add('bi-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('bi-eye-slash');

                icon.classList.add('bi-eye');

            }

        });

    });

    // Loading Button
    document.querySelectorAll('form').forEach(function (form) {

        form.addEventListener('submit', function () {

            const button = form.querySelector('button[type="submit"]');

            if (!button) return;

            button.disabled = true;

            button.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2"></span>
                Memproses...
            `;

        });

    });

});