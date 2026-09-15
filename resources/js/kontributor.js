import './bootstrap';

import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

/*
|--------------------------------------------------------------------------
| Kontributor Dashboard
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Auto Close Alert
    |--------------------------------------------------------------------------
    */

    const alerts = document.querySelectorAll('.alert');

    alerts.forEach((alert) => {

        setTimeout(() => {

            alert.classList.add('fade');

            setTimeout(() => {

                alert.remove();

            }, 300);

        }, 4000);

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Foto Profil
    |--------------------------------------------------------------------------
    */

    const fotoProfil = document.querySelector('input[name="foto_profil"]');

    if (fotoProfil) {

        fotoProfil.addEventListener('change', function () {

            previewImage(this);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Preview Banner
    |--------------------------------------------------------------------------
    */

    const banner = document.querySelector('input[name="foto_banner"]');

    if (banner) {

        banner.addEventListener('change', function () {

            previewImage(this);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Preview Thumbnail
    |--------------------------------------------------------------------------
    */

    const thumbnail = document.querySelector('input[name="thumbnail"]');

    if (thumbnail) {

        thumbnail.addEventListener('change', function () {

            previewImage(this);

        });

    }

});

/*
|--------------------------------------------------------------------------
| Preview Image
|--------------------------------------------------------------------------
*/

function previewImage(input) {

    if (!input.files.length) return;

    const reader = new FileReader();

    reader.onload = function (e) {

        const img = input
            .closest('.card, .col-lg-4, .col-md-4')
            ?.querySelector('img');

        if (img) {

            img.src = e.target.result;

        }

    }

    reader.readAsDataURL(input.files[0]);

}