/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// error failed pop up
function swalErrorMessage(message) {
    swal("Gagal", message, "error");
}

function swalSuccessMessage(message) {
    swal("Sukses", message, "success");
}

// function showConfirmPopup(message) {
//     swal("Sukses", message, "info");
// }

// Fungsi untuk menghitung tanggal panen berdasarkan siklus (jumlah hari)
function hitungTanggalPanen(tanggalTanam, siklus) {
    var tanggalTanamObj = new Date(tanggalTanam);
    var jumlahHari = parseInt(siklus); // Ubah siklus menjadi integer

    if (!isNaN(jumlahHari) && jumlahHari > 0) {
        var tanggalPanenObj = new Date(tanggalTanamObj.getTime() + (jumlahHari * 24 * 60 * 60 * 1000)); // Tambah jumlah hari

        // Format tanggal panen ke dalam string 'YYYY-MM-DD'
        var formattedTanggalPanen = tanggalPanenObj.toISOString().slice(0, 10);

        return formattedTanggalPanen;
    } else {
        return ""; // Jika input siklus tidak valid, kembalikan string kosong
    }
}

// Fungsi untuk menghitung tanggal panen berdasarkan siklus (jumlah hari)
function hitungTanggalPanen(tanggalTanam, siklus) {
    var tanggalTanamObj = new Date(tanggalTanam);
    var jumlahHari = parseInt(siklus); // Ubah siklus menjadi integer

    if (!isNaN(jumlahHari) && jumlahHari > 0) {
        var tanggalPanenObj = new Date(tanggalTanamObj.getTime() + (jumlahHari * 24 * 60 * 60 * 1000)); // Tambah jumlah hari

        // Format tanggal panen ke dalam string 'YYYY-MM-DD'
        var formattedTanggalPanen = tanggalPanenObj.toISOString().slice(0, 10);

        return formattedTanggalPanen;
    } else {
        return ""; // Jika input siklus tidak valid, kembalikan string kosong
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var tanggalTanamInput = document.getElementById("tanggal_tanam");
    var siklusInput = document.getElementById("siklus");
    var tanggalPanenInput = document.getElementById("tanggal_panen");

    // Simpan nilai siklus awal
    // var siklusAwal = siklusInput.value;

    // Fungsi untuk menghitung tanggal panen berdasarkan siklus (jumlah hari)
    function hitungTanggalPanen(tanggalTanam, siklus) {
        var tanggalTanamObj = new Date(tanggalTanam);
        var jumlahHari = parseInt(siklus); // Ubah siklus menjadi integer

        if (!isNaN(jumlahHari) && jumlahHari > 0) {
            var tanggalPanenObj = new Date(
                tanggalTanamObj.getTime() + jumlahHari * 24 * 60 * 60 * 1000
            ); // Tambah jumlah hari

            // Format tanggal panen ke dalam string 'YYYY-MM-DD'
            var formattedTanggalPanen = tanggalPanenObj
                .toISOString()
                .slice(0, 10);

            return formattedTanggalPanen;
        } else {
            return ""; // Jika input siklus tidak valid, kembalikan string kosong
        }
    }

    // Fungsi untuk mengupdate tanggal panen berdasarkan nilai tanggal tanam dan siklus
    function updateTanggalPanen() {
        var tanggalTanam = tanggalTanamInput.value;
        var siklus = siklusInput.value;
        var tanggalPanen = hitungTanggalPanen(tanggalTanam, siklus);

        // Set nilai input tanggal panen
        tanggalPanenInput.value = tanggalPanen;
    }

    // Tambahkan event listener pada tanggal tanam untuk memperbarui tanggal panen saat tanggal berubah
    tanggalTanamInput.addEventListener("input", function () {
        console.log("diganti");
        updateTanggalPanen(); // Panggil fungsi updateTanggalPanen
    });

    // Tambahkan event listener pada siklus untuk memperbarui tanggal panen saat nilai siklus berubah
    siklusInput.addEventListener("input", function () {
        updateTanggalPanen(); // Panggil fungsi updateTanggalPanen
    });

    // Inisialisasi tanggal panen saat halaman dimuat
    updateTanggalPanen();
});

const map = L.map('map').setView([-6.602372, 106.804015], 9);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    tileSize: 512,
    zoomOffset: -1,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let userLocationMarker;
let routingControl;

// Konfigurasi ikon kustom
const customIcon = L.icon({
    iconUrl: '/img/avatar/pin.png', // Ganti dengan path ikon kustom Anda
    iconSize: [38, 38], // Sesuaikan ukuran ikon
    iconAnchor: [19, 38], // Titik anchor ikonnya (tengah bawah ikon)
    popupAnchor: [0, -38] // Titik anchor popup (di atas ikon)
});

$.ajax({
    url: 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/getallwisata', // Ganti URL sesuai dengan endpoint API Anda
    type: 'GET',
    success: function (res) {
        res.forEach(markerData => {
            createMarkerAndPopup(markerData);
        });
    },
    error: function (err) {
        console.log(err);
    }
});

function createMarkerAndPopup(markerData) {
    const marker = L.marker([markerData.lan, markerData.long], { icon: customIcon }).addTo(map);
    const imageSrc = `${markerData.gambar}`;
    const popupContent = `<div><img src="${imageSrc}" alt="Gambar Tempat" style="max-width: 100%; height: auto;"><h3>${markerData.judul}</h3></div>`;
    marker.bindPopup(popupContent, { maxWidth: 300 });

    marker.on('click', function() {
        document.getElementById('sidebar-content').innerHTML = `
            <img src="${imageSrc}" alt="Gambar Tempat" style="max-width: 100%; height: auto;">
            <p><strong>Nama Kebun:</strong> ${markerData.judul}</p>
            <p><strong>No. HP:</strong> ${markerData.Kontak}</p>
        `;
        document.getElementById('btnNavigate').setAttribute('data-lat', markerData.lan);
        document.getElementById('btnNavigate').setAttribute('data-lng', markerData.long);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLatitude = position.coords.latitude;
                const userLongitude = position.coords.longitude;

                if (routingControl) {
                    map.removeControl(routingControl);
                }

                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(userLatitude, userLongitude),
                        L.latLng(markerData.lan, markerData.long)
                    ],
                    routeWhileDragging: false,
                    createMarker: function() { return null; },
                    lineOptions: {
                        addWaypoints: false,
                        styles: [{ color: 'blue', weight: 6 }]
                    }
                }).on('routesfound', function(e) {
                    const route = e.routes[0];
                    const distance = route.summary.totalDistance;
                    const time = route.summary.totalTime;

                    document.getElementById('sidebar-content').innerHTML += `
                        <p><strong>Jarak:</strong> ${(distance / 1000).toFixed(2)} km</p>
                        <p><strong>Perkiraan Waktu Berjalan Kaki:</strong> ${moment.duration(time, "seconds").humanize()}</p>
                        <p><img src="/img/avatar/walk.png" alt="Icon Jalan Kaki" style="width: 24px; vertical-align: middle;"> ${moment.duration(time, "seconds").humanize()}</p>
                    `;
                }).addTo(map);
            });
        }
    });
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        const userLatitude = position.coords.latitude;
        const userLongitude = position.coords.longitude;
        // const userLatitude = -6.593154;
        // const userLongitude = 106.808416;
        console.log("Current Location: Latitude " + userLatitude + ", Longitude " + userLongitude);

        userLocationMarker = L.marker([userLatitude, userLongitude]).addTo(map);
        userLocationMarker.bindPopup("Lokasi Saya").openPopup();
        map.setView([userLatitude, userLongitude], 13);
    });
}

document.getElementById('btnNavigate').addEventListener('click', function () {
    const destinationLat = parseFloat(this.getAttribute('data-lat'));
    const destinationLng = parseFloat(this.getAttribute('data-lng'));

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;

            if (routingControl) {
                map.removeControl(routingControl);
            }

            var start = L.latLng(userLatitude, userLongitude);
            var end = L.latLng(destinationLat, destinationLng);

            routingControl = L.Routing.control({
                waypoints: [
                    start,
                    end
                ],
                routeWhileDragging: true,
                lineOptions: {
                    styles: [{ color: 'blue', weight: 6 }]
                }
                
            }).addTo(map);
        });
    }
});

function updateMapWithUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;

            console.log("Current Location: Latitude " + userLatitude + ", Longitude " + userLongitude);

            if (userLocationMarker) {
                map.removeLayer(userLocationMarker);
            }

            userLocationMarker = L.marker([userLatitude, userLongitude]).addTo(map);
            userLocationMarker.bindPopup("Lokasi Saya").openPopup();
            map.setView([userLatitude, userLongitude], 13);
        });
    }
}

updateMapWithUserLocation();

