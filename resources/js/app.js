import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tu imagen",
    acceptFile: ".png, .jpg, .gif, .jpeg",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const img = {};
            img.size = 1234;
            img.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, img);
            this.options.thumbnail.call(this, img, `/uploads/${img.name}`);

            img.previewElement.classList.add("dz-success", "dz-complete");
        }
    },
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("removedfile", function (file, message) {
    document.querySelector('[name="imagen"]').value = "";
});
