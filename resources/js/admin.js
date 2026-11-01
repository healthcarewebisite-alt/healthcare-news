import "./bootstrap";
import Alpine from "alpinejs";
import "trix";
import "trix/dist/trix.css";

window.Alpine = Alpine;

/**
 * Sidebar toggle state (dipakai di layouts/admin.blade.php via x-data="adminLayout()")
 * PENTING: fungsi ini harus didefinisikan SEBELUM Alpine.start() dipanggil,
 * karena Alpine langsung men-scan DOM begitu start() jalan — jika adminLayout
 * belum ada di window saat itu, x-data="adminLayout()" akan gagal dievaluasi
 * dan sidebar tidak berfungsi (paling terasa di layar mobile).
 */
window.adminLayout = () => ({
    sidebarOpen: window.innerWidth >= 1024,
    init() {
        window.addEventListener("resize", () => {
            this.sidebarOpen = window.innerWidth >= 1024;
        });
    },
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },
});

Alpine.start();

/**
 * Trix Editor - Upload gambar otomatis
 * Backend akan otomatis convert gambar ke .webp (lihat MediaController@uploadEditorImage)
 * Trix mengirim file via event trix-attachment-add, kita upload manual via axios
 * lalu set attributes URL hasil upload (yang sudah .webp).
 */
document.addEventListener("trix-attachment-add", function (event) {
    const attachment = event.attachment;
    if (attachment.file) {
        uploadFileToServer(attachment);
    }
});

function uploadFileToServer(attachment) {
    const form = new FormData();
    form.append("image", attachment.file);

    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/berita/upload-gambar", true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrf);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.upload.addEventListener("progress", function (e) {
        const progress = (e.loaded / e.total) * 100;
        attachment.setUploadProgress(progress);
    });

    xhr.addEventListener("load", function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            const response = JSON.parse(xhr.responseText);
            attachment.setAttributes({
                url: response.url, // path .webp hasil konversi otomatis
                href: response.url,
            });
        } else {
            alert("Gagal mengunggah gambar. Pastikan format didukung (jpg, png, webp, gif) dan ukuran < 5MB.");
        }
    });

    xhr.addEventListener("error", function () {
        alert("Terjadi kesalahan jaringan saat mengunggah gambar.");
    });

    xhr.send(form);
}
