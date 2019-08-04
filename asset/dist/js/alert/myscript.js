

$('.tombol-hapus').on('click', function (e) {
    e.preventDefault();
    const link = $(this).attr('href');
    Swal.fire({
        title: 'Yakin Akan Menghapus Data Ini?',
        text: "Data  Akan Dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data '
    }).then((result) => {
        if (result.value) {
            document.location.href = link;
        }
    })
});
/*$('.tombol-logout').on('click', function (e) {
    e.preventDefault();
    const link = $(this).attr('href');
    Swal.fire({
        title: 'Yakin Akan Log-out Dari Sistem?',
        text: "Konfirmasi",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data '
    }).then((result) => {
        if (result.value) {
            document.location.href = link;
        }
    })
});*/