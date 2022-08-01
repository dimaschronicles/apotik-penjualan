function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

$(document).ready(function () {
    // data tables
    $('#example').DataTable()
    // summernote editor
    $('#summernote').summernote({
        value: 'asdasd',
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    })
});

$(document).ready(function () {
    $('select').select2({
        theme: "bootstrap4",
    });
});

function showPass() {
    let x = document.getElementById("password");
    let y = document.getElementById("password_conf");
    if (x.type === "password" && y.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

function count() {
    let jumlah_uang = document.getElementById('uang_pembeli').value
    let total_harga = document.getElementById('total_harga').value

    let hasil = parseInt(jumlah_uang) - parseInt(total_harga)
    if (!isNaN(hasil)) {
        document.getElementById('uang_kembali').value = hasil
    }
}