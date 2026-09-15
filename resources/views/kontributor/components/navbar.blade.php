<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">

    <div class="container-fluid">

        <h5 class="mb-0 fw-semibold">

            {{ $title }}

        </h5>

        <div class="ms-auto d-flex align-items-center">

            @if(isset($kontributor))

                <div class="text-end me-3">

                    <div class="fw-semibold">

                        {{ $kontributor->nama_kontributor }}

                    </div>

                    <small class="text-muted">

                        Kontributor

                    </small>

                </div>

                <img
                    src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                    class="rounded-circle border"
                    width="45"
                    height="45"
                    style="object-fit:cover;">

            @endif

        </div>

    </div>

</nav>