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
                orderable: false, // Menonaktifkan fitur pengurutan untuk kolom ini
                searchable: false,
                className: "text-center", // Menambahkan kelas text-center untuk kolom pertama
            },
            { data: "nama", name: "nama" },
            { data: "no_telepon", name: "no_telepon" },
            { data: "email", name: "email" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false, // Menonaktifkan fitur pengurutan untuk kolom ini
                searchable: false,
                className: "text-center opsi-col",
                width: "90px", // Menambahkan kelas text-center untuk kolom opsi
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
                width: "2px",
                orderable: false,
                searchable: false,
                className: "text-center", // Center align for the first column
            },
            { data: "nama", name: "nama" },
            { data: "no_telepon", name: "no_telepon" },
            { data: "email", name: "email" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                className: "text-center opsi-col",
                width: "90px", // Added class for the options column
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
    });

    // Inisialisasi DataTable
    $("#bukuTable").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#buku-table-url").val(),
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
                className: "text-center",
                orderable: false, // Menonaktifkan sorting untuk kolom pertama
            },
            { data: "judul", name: "judul" },
            { data: "penulis", name: "penulis" },
            { data: "penerbit", name: "penerbit" },
            { data: "tahun_terbit", name: "tahun_terbit" },
            { data: "status_ketersediaan", name: "status_ketersediaan" },
            { data: "stok", name: "stok" },
            { data: "kategori", name: "kategori" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                className: "text-center",
                width: "125px",
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                width: "50px",
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        return (
                            ("0" + date.getDate()).slice(-2) +
                            "-" +
                            ("0" + (date.getMonth() + 1)).slice(-2) +
                            "-" +
                            date.getFullYear()
                        );
                    }
                    return "";
                },
            },
            {
                data: "updated_at",
                name: "updated_at",
                render: function (data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        return (
                            ("0" + date.getDate()).slice(-2) +
                            "-" +
                            ("0" + (date.getMonth() + 1)).slice(-2) +
                            "-" +
                            date.getFullYear()
                        );
                    }
                    return "";
                },
            },
            { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],

        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        var date = new Date(data);
                        var day = ("0" + date.getDate()).slice(-2);
                        var month = ("0" + (date.getMonth() + 1)).slice(-2);
                        var year = date.getFullYear();
                        return day + "-" + month + "-" + year;
                    }
                    return data;
                },
            },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                width: "50px",
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        var day = ("0" + date.getDate()).slice(-2);
                        var month = ("0" + (date.getMonth() + 1)).slice(-2);
                        var year = date.getFullYear();
                        return day + "-" + month + "-" + year;
                    }
                    return "";
                },
            },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                width: "50px",
            },
        ],

        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                    });
                },
            },
            {
                data: "updated_at",
                name: "updated_at",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                    });
                },
            },
            {
                data: "status",
                name: "status",
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            //    { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                    });
                },
            },
            {
                data: "updated_at",
                name: "updated_at",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                    });
                },
            },
            { data: "status", name: "status" },
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                width: "50px",
            },
        ],

        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            //    { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
                width: "50px",
            },
        ],
        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            //    { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
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
            {
                data: "opsi",
                name: "opsi",
                orderable: false,
                searchable: false,
                width: "90px",
            },
        ],

        columnDefs: [
            { targets: 0, className: "text-center" }, // Menambahkan kelas text-center untuk kolom pertama
            //    { targets: -1, className: "text-center opsi-col" }, // Menambahkan kelas text-center untuk kolom terakhir
        ],
        order: [], // Tidak ada sorting awal yang diterapkan
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        drawCallback: function () {
            // Tambahkan radius pada input pencarian
            $(".dt-input").css({
                borderRadius: "8px", // Radius sudut input pencarian
                padding: "5px", // Padding dalam input pencarian
                border: "1px solid #ced4da",
                marginRight: "2px", // Border input pencarian
            });
        },
    });
});
