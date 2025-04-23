$(document).ready(function () {
    $(".site-name").select2({
        placeholder: "Select Site Name",
        allowClear: true,
        ajax: {
            url: "/api/datasites",
            dataType: "json",
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.data.map(function (data) {
                        return {
                            id: data.id,
                            text: data.sitename,
                        };
                    }),
                };
            },
            cache: true,
        },
    });

    $(".site-name").on("select2:select", function (e) {
        const siteId = e.params.data.id;

        $.ajax({
            url: `/api/datasites/${siteId}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $("#idsite").val(response.data.id);
                    $("#tipe").val(response.data.tipe);
                    $("#batch").val(response.data.batch);
                    $("#latitude").val(response.data.latitude);
                    $("#longitude").val(response.data.longitude);
                    $("#provinsi").val(response.data.provinsi);
                    $("#kab").val(response.data.kab);
                    $("#kecamatan").val(response.data.kecamatan);
                    $("#kelurahan").val(response.data.kelurahan);
                    $("#alamat_lokasi").val(response.data.alamat_lokasi);
                    $("#nama_pic").val(response.data.nama_pic);
                    $("#nomor_pic").val(response.data.nomor_pic);
                    $("#sumber_listrik").val(response.data.sumber_listrik);
                    $("#gateway_area").val(response.data.gateway_area);
                    $("#beam").val(response.data.beam);
                    $("#hub").val(response.data.hub);
                    $("#kodefikasi").val(response.data.kodefikasi);
                    $("#sn_antena").val(response.data.sn_antena);
                    $("#sn_modem").val(response.data.sn_modem);
                    $("#sn_router").val(response.data.sn_router);
                    $("#sn_ap1").val(response.data.sn_ap1);
                    $("#sn_ap2").val(response.data.sn_ap2);
                    $("#sn_tranciever").val(response.data.sn_tranciever);
                    $("#sn_stabilizer").val(response.data.sn_stabilizer);
                    $("#sn_rak").val(response.data.sn_rak);
                    $("#ip_modem").val(response.data.ip_modem);
                    $("#ip_router").val(response.data.ip_router);
                    $("#ip_ap1").val(response.data.ip_ap1);
                    $("#ip_ap2").val(response.data.ip_ap2);
                    $("#expected_sqf").val(response.data.expected_sqf);
                }
            },
            error: function () {
                alert("Gagal ambil data site.");
            },
        });
    });
});
