$(document).ready(function () {
    // Handle modal open and populate the form
    $(document).on("click", 'button[data-bs-toggle="modal"]', async function () {
        var modalTarget = $(this).data("bs-target");
        let kelas_id = $(this).data("id");

        try {
            const response = await $.ajax({
                url: `getData/WaktuAbsen/${kelas_id}`,
                type: "GET",
                dataType: "json",
                cache: false,
            });

            if (response && response.data) {
                $("#id").val(response.data.id);
                $("#mulai_absen_masuk").val(response.data.mulai_absen_masuk);
                $("#akhir_absen_masuk").val(response.data.akhir_absen_masuk);
                $("#mulai_absen_pulang").val(response.data.mulai_absen_pulang);
                $("#akhir_absen_pulang").val(response.data.akhir_absen_pulang);
            }

            // Tampilkan modal setelah data terisi
            $(modalTarget).modal("show");
        } catch (xhr) {
            console.error("Terjadi kesalahan saat mengambil data: ", xhr.responseText);
        }
    });


    // Handle form submission
    const submitButton = document.querySelector(
        '[data-kt-editdatamahasiswa-modal-action="submit"]'
    );
    const form = document.getElementById("kt_modal_input_jam_absen_form");

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            // Get mahasiswa_id from the hidden input
            let pertemuan_id = $("#id").val();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // AJAX PUT request
                $.ajax({
                    type: "POST",
                    url: `updateWaktuAbsenKelas/${pertemuan_id}`,
                    data: $(form).serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: `Data berhasil diperbarui!`,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.reset();
                                $("#kt_modal_input_waktu_uploadtugas").modal("hide");
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: "Terjadi Kesalahan!, Silahkan Cek Data Anda Kembali",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    },
                });
            };

            // Validate form
            if (typeof o !== "undefined" && o.validate) {
                o.validate().then(function (status) {
                    if (status === "Valid") {
                        handleFormSubmit();
                    } else {
                        Swal.fire({
                            text: "Silahkan cek data Anda kembali.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            } else {
                // Jika tidak menggunakan library validasi
                handleFormSubmit();
            }
        });
    }

    // Handle form reset
    const resetButtons = document.querySelectorAll(
        '[data-kt-reseteditusers-modal-action="cancel"], [data-kt-resetataseditusers-modal-action="cancel"]'
    );

    resetButtons.forEach((resetButton) => {
        resetButton.addEventListener("click", function (event) {
            event.preventDefault();
            Swal.fire({
                text: "Apakah Anda yakin ingin membatalkan perubahan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.reset();
                    $("#kt_modal_edit_datamahasiswa").modal("hide");
                }
            });
        });
    });
});
