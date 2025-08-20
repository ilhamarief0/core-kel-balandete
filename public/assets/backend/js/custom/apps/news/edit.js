"use strict";

var KTNewsEdit = (function () {
    const form = document.getElementById("kt_modal_edit_news_form");
    const submitButton = form.querySelector('[data-kt-news-add-action="submit"]');
    let newsEditorInstance;
    const editUrl = form.getAttribute('data-edit-url');

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('upload', file);

                    $.ajax({
                        url: '/uploadckEditorImage',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        xhr: function() {
                            const xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', evt => {
                                if (evt.lengthComputable) {
                                    const percent = Math.round((evt.loaded / evt.total) * 100);
                                }
                            }, false);
                            return xhr;
                        },
                        success: function(response) {
                            if (response.url) {
                                resolve({
                                    default: response.url
                                });
                            } else {
                                reject('Upload failed: No URL returned from server.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Image upload failed:", xhr.responseText);
                            let errorMessage = 'Upload failed.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = 'Upload failed: ' + xhr.responseJSON.error;
                            } else if (error) {
                                errorMessage = 'Upload failed: ' + error;
                            }
                            reject(errorMessage);
                        }
                    });
                }));
        }
    }

    const handleFormSubmit = function () {
        if (!submitButton) {
            console.error("Submit button for news edit not found.");
            return;
        }

        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            if (typeof FormValidation === "undefined") {
                console.warn("FormValidation library not found. Skipping client-side validation.");
                sendFormData();
                return;
            }

            var validation = FormValidation.formValidation(form, {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: "Judul Berita wajib diisi",
                            },
                        },
                    },
                    // Hapus atau perbaiki validasi 'image' agar hanya berlaku jika ada file baru
                    // atau tidak wajib jika tidak ada perubahan gambar utama.
                    // Untuk gambar CKEditor, validasinya cukup melalui konten 'content'.
                    image: {
                        validators: {
                            // Cek apakah ada file yang dipilih untuk validasi ini
                            file: {
                                extension: 'png,jpg,jpeg',
                                type: 'image/jpeg,image/png',
                                maxFiles: 1,
                                message: 'Jenis file yang diizinkan adalah png, jpg, atau jpeg.',
                            },
                        },
                    },
                    content: {
                        validators: {
                            callback: {
                                message: 'Konten berita wajib diisi',
                                callback: function (input) {
                                    if (newsEditorInstance) {
                                        const editorData = newsEditorInstance.getData();
                                        // Periksa apakah konten tidak kosong setelah membersihkan tag HTML dasar
                                        return editorData.replace(/<[^>]*>?/gm, '').trim().length > 0;
                                    }
                                    return false;
                                }
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: "",
                    }),
                },
            });

            validation.validate().then(function (status) {
                console.log("Form validation status:", status);
                if (status == "Valid") {
                    sendFormData();
                } else {
                    Swal.fire({
                        text: "Terjadi Kesalahan Validasi! Silakan Cek Data Anda Kembali.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Oke, mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    function sendFormData() {
        console.log("Sending form data for edit...");
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        const formData = new FormData(form);
        // Pastikan konten CKEditor diambil sebelum dikirim
        if (newsEditorInstance) {
            formData.set('content', newsEditorInstance.getData());
        }

        $.ajax({
            url: editUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log("AJAX submit success:", response);
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                Swal.fire({
                    text: response.message || `Berita Berhasil Diperbarui!`,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Oke, mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = response.redirect_url || '/backend/news';
                    }
                });
            },
            error: function (xhr) {
                console.error("AJAX submit failed:", xhr);
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                Swal.fire({
                    text: xhr.responseJSON?.message || 'Terjadi Kesalahan! Silakan Cek Data Anda Kembali.',
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Oke, mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
            }
        });
    }

    return {
        init: function () {
            console.log("KTNewsEdit.init() called.");
            ClassicEditor
                .create(document.querySelector('#kt_docs_ckeditor_classic'), {
                    extraPlugins: [ MyCustomUploadAdapterPlugin ],
                    height: '400px',
                    minHeight: '400px',
                })
                .then(editor => {
                    console.log("CKEditor initialized:", editor);
                    newsEditorInstance = editor;
                    handleFormSubmit();
                })
                .catch(error => {
                    console.error("Error initializing CKEditor:", error);
                });
        }
    };
})();

$(document).ready(function() {
    KTNewsEdit.init();
});
