$(document).ready(function () {
    // DataTable untuk tabel anggota
    $("#memberTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#table-url").val(),
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "nama", name: "nama" },
            { data: "no_telepon", name: "no_telepon" },
            { data: "email", name: "email" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });
    $("#adminTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#admin-table-url").val(),
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "nama", name: "nama" },
            { data: "no_telepon", name: "no_telepon" },
            { data: "email", name: "email" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });

    // DataTable untuk tabel buku
    $("#bukuTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#buku-table-url").val(), // Mengambil URL dari elemen input tersembunyi
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul", name: "judul" },
            { data: "penulis", name: "penulis" },
            { data: "penerbit", name: "penerbit" },
            { data: "tahun_terbit", name: "tahun_terbit" },
            { data: "status_ketersediaan", name: "status_ketersediaan" },
            { data: "stok", name: "stok" },
            { data: "kategori", name: "kategori" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });
    $("#bukumemberTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#bukumember-table-url").val(), // Mengambil URL dari elemen input tersembunyi
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul", name: "judul" },
            { data: "penulis", name: "penulis" },
            { data: "penerbit", name: "penerbit" },
            { data: "tahun_terbit", name: "tahun_terbit" },
            { data: "status_ketersediaan", name: "status_ketersediaan" },
            { data: "stok", name: "stok" },
            { data: "kategori", name: "kategori" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });

    // DataTable untuk tabel kategoribuku
    $("#kategoriTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#kategori-table-url").val(), // Mengambil URL dari elemen input tersembunyi
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "nama_kategori", name: "nama_kategori" },
            { data: "deskripsi_kategori", name: "deskripsi_kategori" },
            { data: "tanggal_dibuat", name: "tanggal_dibuat" },
            { data: "tanggal_diperbarui", name: "tanggal_diperbarui" },
            { data: "status", name: "status" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });

    // DataTable untuk tabel peminjaman
    $("#peminjamanTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#peminjaman-table-url").val(),
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul_buku", name: "judul_buku" },
            { data: "nama_member", name: "nama_member" },
            { data: "tanggal_peminjaman", name: "tanggal_peminjaman" },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
            },
        ],
    });
    var userName = $("#user-id").val(); // Get user name

    $("#peminjamanmemberTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#peminjamanmember-table-url").val(),
            type: "GET",
            data: function (d) {
                d.user_name = userName; // Send user name as a parameter
            },
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul_buku", name: "judul_buku" },
            { data: "nama_member", name: "nama_member" },
            { data: "tanggal_peminjaman", name: "tanggal_peminjaman" },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // DataTable untuk tabel pengembalian
    $("#pengembalianTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#pengembalian-table-url").val(),
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul_buku", name: "judul_buku" },
            { data: "nama_member", name: "nama_member" },
            { data: "tanggal_peminjaman", name: "tanggal_peminjaman" },
            { data: "tanggal_pengembalian", name: "tanggal_pengembalian" },
            {
                data: "status",
                name: "status",
            },
        ],
    });

    var userName = $("#user-id").val(); // Get user name

    $("#pgmemberTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#pgmember-table-url").val(),
            type: "GET",
            data: function (d) {
                d.user_name = userName; // Send user name as a parameter
            },
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "judul_buku", name: "judul_buku" },
            { data: "nama_member", name: "nama_member" },
            { data: "tanggal_peminjaman", name: "tanggal_peminjaman" },
            { data: "tanggal_pengembalian", name: "tanggal_pengembalian" },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
            },
        ],
    });
    $("#roleTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#role-table-url").val(),
            type: "GET",
            data: function (d) {
                d.user_name = userName; // Send user name as a parameter
            },
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            { data: "guard_name", name: "guard_name" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
            },
        ],
    });
    $("#userTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#user-table-url").val(),
            type: "GET",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                alert(
                    "Terjadi kesalahan saat memuat data. Silakan coba lagi nanti."
                );
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "nama", name: "nama" },
            { data: "no_telepon", name: "no_telepon" },
            { data: "email", name: "email" },
            { data: "roles", name: "roles" },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });
});
