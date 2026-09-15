// This event listener runs once the entire HTML document has been loaded.
document.addEventListener('DOMContentLoaded', function () {
    const mainLayout = document.querySelector('.main-layout');
    const toggler = document.getElementById('universal-toggler');
    const sidebarNavLinks = document.querySelectorAll('#sidebar .nav-pills .nav-link');

    // --- Sidebar Toggle Logic ---
    const toggleSidebar = () => {
        mainLayout.classList.toggle('sidebar-collapsed');
    };

    // Event listener for the universal toggle button
    if (toggler) {
        toggler.addEventListener('click', toggleSidebar);
    }
    
    // Automatically collapse sidebar on smaller screens on initial load
    if (window.innerWidth < 992) {
        mainLayout.classList.add('sidebar-collapsed');
    }

    // --- Active Navigation Link Logic ---
    // This logic runs on page load to set the correct 'active' link
    // based on the current URL. This makes the active state work
    // across different pages.
    let isLinkActive = false;

    sidebarNavLinks.forEach(link => {
        // Skip dropdown toggles in this logic
        if (link.classList.contains('dropdown-toggle')) {
            return;
        }
        
        // Compare the link's full resolved URL with the current page's URL
        // `link.href` gives the full absolute URL (e.g., "http://.../tes1.html")
        if (link.href === window.location.href) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
            isLinkActive = true;
        } else {
            // Ensure other links are not active
            link.classList.remove('active');
            link.removeAttribute('aria-current');
        }
    });

    // Fallback: If no specific link matched (e.g., you are on the root domain),
    // activate the first navigation link, which is typically the Dashboard.
    if (!isLinkActive && sidebarNavLinks.length > 0) {
            const firstLink = sidebarNavLinks[0];
            if (firstLink && !firstLink.classList.contains('dropdown-toggle')) {
            firstLink.classList.add('active');
            firstLink.setAttribute('aria-current', 'page');
            }
    }
});



// BUAT LIAT GAMBAR
// // Fungsi untuk menampilkan preview gambar
// function previewImage() {
//     const image = document.querySelector('#gambar');
//     const imgPreview = document.querySelector('.img-preview');

//     const oFReader = new FileReader();
//     oFReader.readAsDataURL(image.files[0]);

//     oFReader.onload = function(oFREvent) {
//         imgPreview.src = oFREvent.target.result;
//     }
// }


// TRANSAKSI
// // ... (Kode JavaScript dari create.blade.php sebelumnya diletakkan di sini) ...
// document.addEventListener('DOMContentLoaded', function () {
//     // State management
//     let cart = [];

//     // Element selectors
//     const produkSelect = document.getElementById('produk_id');
//     const jumlahInput = document.getElementById('jumlah');
//     const btnTambahProduk = document.getElementById('btn-tambah-produk');
//     const keranjangBody = document.getElementById('keranjang-body');
//     const totalHargaDisplay = document.getElementById('total-harga-display');
//     const totalHargaInput = document.getElementById('total_harga_input');
//     const jumlahBayarInput = document.getElementById('jumlah_bayar');
//     const kembalianDisplay = document.getElementById('kembalian-display');
//     const formPenjualan = document.getElementById('form-penjualan');

//     // Event Listeners
//     btnTambahProduk.addEventListener('click', handleTambahProduk);
//     jumlahBayarInput.addEventListener('input', updatePembayaran);
//     formPenjualan.addEventListener('submit', handleFormSubmit);
//     keranjangBody.addEventListener('click', handleKeranjangAction);

//     function handleTambahProduk() {
//         const selectedOption = produkSelect.options[produkSelect.selectedIndex];
//         if (!selectedOption.value) {
//             alert('Pilih produk terlebih dahulu.');
//             return;
//         }

//         const produkId = parseInt(selectedOption.value);
//         const produkNama = selectedOption.text.split(' (Stok:')[0];
//         const produkHarga = parseFloat(selectedOption.dataset.harga);
//         const produkStok = parseInt(selectedOption.dataset.stok);
//         const jumlah = parseInt(jumlahInput.value);

//         if (jumlah <= 0) {
//             alert('Jumlah harus lebih dari 0.');
//             return;
//         }

//         const itemDiKeranjang = cart.find(item => item.id_produk === produkId);
//         const jumlahDiKeranjang = itemDiKeranjang ? itemDiKeranjang.jumlah : 0;

//         if (jumlah + jumlahDiKeranjang > produkStok) {
//             alert(`Stok tidak mencukupi. Sisa stok: ${produkStok}`);
//             return;
//         }

//         if (itemDiKeranjang) {
//             // Update jumlah jika produk sudah ada di keranjang
//             itemDiKeranjang.jumlah += jumlah;
//         } else {
//             // Tambah produk baru ke keranjang
//             cart.push({
//                 id_produk: produkId,
//                 nama: produkNama,
//                 harga: produkHarga,
//                 jumlah: jumlah,
//                 stok: produkStok
//             });
//         }

//         renderCart();
//         updatePembayaran();
//     }
    
//     function handleKeranjangAction(event) {
//         if (event.target.classList.contains('btn-hapus-item')) {
//             const produkId = parseInt(event.target.dataset.id);
//             cart = cart.filter(item => item.id_produk !== produkId);
//             renderCart();
//             updatePembayaran();
//         }
//     }

//     function renderCart() {
//         keranjangBody.innerHTML = '';
//         if (cart.length === 0) {
//             keranjangBody.innerHTML = '<tr><td colspan="5" class="text-center">Keranjang kosong</td></tr>';
//         } else {
//             cart.forEach(item => {
//                 const subtotal = item.harga * item.jumlah;
//                 const row = `
//                     <tr>
//                         <td>${item.nama}</td>
//                         <td>${formatRupiah(item.harga)}</td>
//                         <td>
//                             <input type="number" class="form-control form-control-sm item-jumlah" value="${item.jumlah}" min="1" max="${item.stok}" data-id="${item.id_produk}">
//                         </td>
//                         <td>${formatRupiah(subtotal)}</td>
//                         <td>
//                             <button type="button" class="btn btn-danger btn-sm btn-hapus-item" data-id="${item.id_produk}">&times;</button>
//                         </td>
//                     </tr>
//                 `;
//                 keranjangBody.insertAdjacentHTML('beforeend', row);
//             });
//             // Add event listeners for quantity inputs in the cart
//             document.querySelectorAll('.item-jumlah').forEach(input => {
//                 input.addEventListener('change', handleJumlahChange);
//             });
//         }
//     }
    
//     function handleJumlahChange(event) {
//         const produkId = parseInt(event.target.dataset.id);
//         const jumlahBaru = parseInt(event.target.value);
//         const item = cart.find(i => i.id_produk === produkId);

//         if (jumlahBaru > item.stok) {
//             alert(`Stok tidak mencukupi. Sisa stok: ${item.stok}`);
//             event.target.value = item.jumlah; // Kembalikan ke jumlah sebelumnya
//             return;
//         }
        
//         if (jumlahBaru <= 0) {
//             cart = cart.filter(i => i.id_produk !== produkId);
//         } else {
//             item.jumlah = jumlahBaru;
//         }
//         renderCart();
//         updatePembayaran();
//     }

//     function updatePembayaran() {
//         const totalHarga = cart.reduce((total, item) => total + (item.harga * item.jumlah), 0);
//         totalHargaDisplay.textContent = formatRupiah(totalHarga);
//         totalHargaInput.value = totalHarga;

//         const jumlahBayar = parseFloat(jumlahBayarInput.value) || 0;
//         const kembalian = jumlahBayar - totalHarga;
        
//         kembalianDisplay.textContent = formatRupiah(Math.max(0, kembalian));
//     }

//     function handleFormSubmit(event) {
//         event.preventDefault();

//         if (cart.length === 0) {
//             alert('Keranjang belanja kosong. Tambahkan produk terlebih dahulu.');
//             return;
//         }
        
//         const totalHarga = parseFloat(totalHargaInput.value);
//         const jumlahBayar = parseFloat(jumlahBayarInput.value);

//         if (jumlahBayar < totalHarga) {
//             alert('Jumlah bayar tidak mencukupi.');
//             return;
//         }

//         // Hapus input cart lama jika ada
//         document.querySelectorAll('input[name^="cart["]').forEach(input => input.remove());

//         // Tambahkan data keranjang sebagai input tersembunyi
//         cart.forEach((item, index) => {
//             formPenjualan.insertAdjacentHTML('beforeend', `<input type="hidden" name="cart[${index}][id_produk]" value="${item.id_produk}">`);
//             formPenjualan.insertAdjacentHTML('beforeend', `<input type="hidden" name="cart[${index}][jumlah]" value="${item.jumlah}">`);
//         });

//         formPenjualan.submit();
//     }
    
//     function formatRupiah(angka) {
//         return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
//     }

//     // Initial render
//     renderCart();
// });

// yang dipake dibawah ini tanggal 02 - juli - 2025 
// document.addEventListener('DOMContentLoaded', function () {
//     // State management
//     let cart = [];

//     // Element selectors
//     const produkSelect = document.getElementById('produk_id');
//     const jumlahInput = document.getElementById('jumlah');
//     const btnTambahProduk = document.getElementById('btn-tambah-produk');
//     const keranjangBody = document.getElementById('keranjang-body');
//     const totalHargaDisplay = document.getElementById('total-harga-display');
//     const totalHargaInput = document.getElementById('total_harga_input');
//     const jumlahBayarInput = document.getElementById('jumlah_bayar');
//     const kembalianDisplay = document.getElementById('kembalian-display');
//     const formPenjualan = document.getElementById('form-penjualan');

//     // --- LOGIKA BARU UNTUK PELANGGAN ---
//     const isNewCustomerCheckbox = document.getElementById('is_new_customer');
//     const existingCustomerSection = document.getElementById('existing-customer-section');
//     const newCustomerSection = document.getElementById('new-customer-section');

//     isNewCustomerCheckbox.addEventListener('change', function() {
//         if (this.checked) {
//             existingCustomerSection.classList.add('d-none');
//             newCustomerSection.classList.remove('d-none');
//         } else {
//             existingCustomerSection.classList.remove('d-none');
//             newCustomerSection.classList.add('d-none');
//         }
//     });
//     // --- AKHIR LOGIKA BARU ---

//     // Event Listeners
//     btnTambahProduk.addEventListener('click', handleTambahProduk);
//     jumlahBayarInput.addEventListener('input', updatePembayaran);
//     formPenjualan.addEventListener('submit', handleFormSubmit);
//     keranjangBody.addEventListener('click', handleKeranjangAction);

//     function handleTambahProduk() {
//         const selectedOption = produkSelect.options[produkSelect.selectedIndex];
//         if (!selectedOption.value) {
//             alert('Pilih produk terlebih dahulu.');
//             return;
//         }

//         const produkId = parseInt(selectedOption.value);
//         const produkNama = selectedOption.text.split(' (Stok:')[0];
//         const produkHarga = parseFloat(selectedOption.dataset.harga);
//         const produkStok = parseInt(selectedOption.dataset.stok);
//         const jumlah = parseInt(jumlahInput.value);

//         if (jumlah <= 0) {
//             alert('Jumlah harus lebih dari 0.');
//             return;
//         }

//         const itemDiKeranjang = cart.find(item => item.id_produk === produkId);
//         const jumlahDiKeranjang = itemDiKeranjang ? itemDiKeranjang.jumlah : 0;

//         if (jumlah + jumlahDiKeranjang > produkStok) {
//             alert(`Stok tidak mencukupi. Sisa stok: ${produkStok}`);
//             return;
//         }

//         if (itemDiKeranjang) {
//             itemDiKeranjang.jumlah += jumlah;
//         } else {
//             cart.push({
//                 id_produk: produkId,
//                 nama: produkNama,
//                 harga: produkHarga,
//                 jumlah: jumlah,
//                 stok: produkStok
//             });
//         }

//         renderCart();
//         updatePembayaran();
//     }
    
//     function handleKeranjangAction(event) {
//         if (event.target.classList.contains('btn-hapus-item')) {
//             const produkId = parseInt(event.target.dataset.id);
//             cart = cart.filter(item => item.id_produk !== produkId);
//             renderCart();
//             updatePembayaran();
//         }
//     }

//     function renderCart() {
//         keranjangBody.innerHTML = '';
//         if (cart.length === 0) {
//             keranjangBody.innerHTML = '<tr><td colspan="5" class="text-center">Keranjang kosong</td></tr>';
//         } else {
//             cart.forEach(item => {
//                 const subtotal = item.harga * item.jumlah;
//                 const row = `
//                     <tr>
//                         <td>${item.nama}</td>
//                         <td>${formatRupiah(item.harga)}</td>
//                         <td>
//                             <input type="number" class="form-control form-control-sm item-jumlah" value="${item.jumlah}" min="1" max="${item.stok}" data-id="${item.id_produk}">
//                         </td>
//                         <td>${formatRupiah(subtotal)}</td>
//                         <td>
//                             <button type="button" class="btn btn-danger btn-sm btn-hapus-item" data-id="${item.id_produk}">&times;</button>
//                         </td>
//                     </tr>
//                 `;
//                 keranjangBody.insertAdjacentHTML('beforeend', row);
//             });
//             document.querySelectorAll('.item-jumlah').forEach(input => {
//                 input.addEventListener('change', handleJumlahChange);
//             });
//         }
//     }
    
//     function handleJumlahChange(event) {
//         const produkId = parseInt(event.target.dataset.id);
//         const jumlahBaru = parseInt(event.target.value);
//         const item = cart.find(i => i.id_produk === produkId);

//         if (jumlahBaru > item.stok) {
//             alert(`Stok tidak mencukupi. Sisa stok: ${item.stok}`);
//             event.target.value = item.jumlah;
//             return;
//         }
        
//         if (jumlahBaru <= 0) {
//             cart = cart.filter(i => i.id_produk !== produkId);
//         } else {
//             item.jumlah = jumlahBaru;
//         }
//         renderCart();
//         updatePembayaran();
//     }

//     function updatePembayaran() {
//         const totalHarga = cart.reduce((total, item) => total + (item.harga * item.jumlah), 0);
//         totalHargaDisplay.textContent = formatRupiah(totalHarga);
//         totalHargaInput.value = totalHarga;

//         const jumlahBayar = parseFloat(jumlahBayarInput.value) || 0;
//         const kembalian = jumlahBayar - totalHarga;
        
//         kembalianDisplay.textContent = formatRupiah(Math.max(0, kembalian));
//     }

//     function handleFormSubmit(event) {
//         event.preventDefault();

//         if (cart.length === 0) {
//             alert('Keranjang belanja kosong. Tambahkan produk terlebih dahulu.');
//             return;
//         }
        
//         const totalHarga = parseFloat(totalHargaInput.value);
//         const jumlahBayar = parseFloat(jumlahBayarInput.value);

//         if (jumlahBayar < totalHarga) {
//             alert('Jumlah bayar tidak mencukupi.');
//             return;
//         }

//         document.querySelectorAll('input[name^="cart["]').forEach(input => input.remove());

//         cart.forEach((item, index) => {
//             formPenjualan.insertAdjacentHTML('beforeend', `<input type="hidden" name="cart[${index}][id_produk]" value="${item.id_produk}">`);
//             formPenjualan.insertAdjacentHTML('beforeend', `<input type="hidden" name="cart[${index}][jumlah]" value="${item.jumlah}">`);
//         });

//         formPenjualan.submit();
//     }
    
//     function formatRupiah(angka) {
//         return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
//     }

//     renderCart();
// });

// ga bisa di inspek

