"use strict";

// Function to convert selected image to base64 string
function convertToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            const image = new Image();
            image.src = reader.result;
            image.onload = () => {
                const canvas = document.createElement("canvas");
                const aspectRatio = 16 / 9; // Rasio lebar terhadap tinggi
                let width = image.width;
                let height = image.height;

                // Menentukan ukuran gambar yang akan di-crop
                if (width / height > aspectRatio) {
                    width = height * aspectRatio;
                } else {
                    height = width / aspectRatio;
                }

                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(image, 0, 0, width, height);
                const compressedBase64 = canvas.toDataURL("image/jpeg", 0.6); // Set the image quality (0.7 = 70%)
                resolve(compressedBase64);
            };
        };
        reader.onerror = (error) => reject(error);
    });
}

// Event listener for when a file is selected
// document
//     .getElementById("image-upload")
//     .addEventListener("change", async function () {
//         const file = this.files[0]; // Get the selected file
//         if (file) {
//             try {
//                 const base64String = await convertToBase64(file); // Convert file to base64 with compression
//                 console.log(base64String); // Output the base64 string
//                 document.getElementById("image-base64").src = base64String;
//                 document.getElementById("gambar_berita").value = base64String;
//             } catch (error) {
//                 console.error("Error converting file to base64:", error);
//             }
//         }
//     });

// document.getElementById("image-base64");

// revisi console log
// Check if the element with ID 'image-upload' exists
const imageUploadElement = document.getElementById("image-upload");

if (imageUploadElement) {
    // Add event listener for when a file is selected
    imageUploadElement.addEventListener("change", async function () {
        const file = this.files[0]; // Get the selected file
        if (file) {
            try {
                const base64String = await convertToBase64(file); // Convert file to base64 with compression
                console.log(base64String); // Output the base64 string

                // Set the base64 string as the source of an image element
                const imageElement = document.getElementById("image-base64");
                if (imageElement) {
                    imageElement.src = base64String;
                } else {
                    console.log("Image element not found on the page."); // Log if image element is not found
                }

                // Set the base64 string to the value of an input element
                const inputElement = document.getElementById("gambar_input");
                if (inputElement) {
                    inputElement.value = base64String;
                } else {
                    console.log("Input element not found on the page."); // Log if input element is not found
                }
            } catch (error) {
                console.error("Error converting file to base64:", error);
            }
        }
    });
} else {
    console.log("No data image: element with ID 'image-upload' not found."); // Log if image-upload element is not found
}

// Accessing element with ID 'image-base64'
const imageBase64Element = document.getElementById("image-base64");
if (imageBase64Element) {
    // Do something with the 'image-base64' element if it exists
} else {
    console.log("Element with ID 'image-base64' not found."); // Log if image-base64 element is not found
}

// Event listener untuk mendengarkan perubahan pada input
const linkVideoMateri = document.getElementById('link_video_materi');

// Fungsi untuk mendapatkan ID video YouTube dari berbagai format URL
function getYoutubeVideoId(videoLink) {
    let videoId = '';
    const url = new URL(videoLink);

    if (url.hostname === 'youtu.be') {
        // Jika URL menggunakan format youtu.be
        videoId = url.pathname.substr(1);
    } else if (url.hostname === 'www.youtube.com') {
        // Jika URL menggunakan format www.youtube.com
        if (url.searchParams.has('v')) {
            videoId = url.searchParams.get('v');
        } else {
            videoId = url.pathname.substr(1);
        }
    }

    return videoId;
}

if(linkVideoMateri){
    linkVideoMateri.addEventListener("input", showVideoPreview);
    // Fungsi untuk menampilkan preview video YouTube
    function showVideoPreview() {
        const videoLinkInput = document.getElementById("link_video_materi");
        const youtubePlayer = document.getElementById("youtube-player");

        // Mendapatkan link video dari input
        const videoLink = videoLinkInput.value.trim();

        // Cek apakah link video valid dan ambil ID video YouTube
        const videoId = getYoutubeVideoId(videoLink);

        // Update URL iframe dengan URL video YouTube jika videoId ada
        if (videoId) {
            const videoUrl = `https://www.youtube.com/embed/${videoId}`;
            youtubePlayer.src = videoUrl;
        } else {
            // Jika link tidak valid atau tidak ada ID video, tampilkan pesan kesalahan
            alert("Link video tidak valid. Pastikan link YouTube valid.");
        }
    }
}

// REVISI
// // Event listener untuk mendengarkan perubahan pada input
// const linkVideoMateri = document.getElementById('link_video_materi');
// const youtubePlayer = document.getElementById('youtube-player');

// if (linkVideoMateri) {
//     // Panggil showVideoPreview saat halaman dimuat untuk memeriksa apakah ada nilai awal
//     showVideoPreview();

//     linkVideoMateri.addEventListener('input', showVideoPreview);

//     // Fungsi untuk menampilkan preview video YouTube
//     function showVideoPreview() {
//         // Mendapatkan link video dari input
//         const videoLink = linkVideoMateri.value.trim();

//         // Cek apakah link video valid dan ambil ID video YouTube
//         const videoId = getYoutubeVideoId(videoLink);

//         // Update URL iframe dengan URL video YouTube jika videoId ada
//         if (videoId) {
//             const videoUrl = `https://www.youtube.com/embed/${videoId}`;
//             youtubePlayer.src = videoUrl;
//             youtubePlayer.style.display = 'block'; // Tampilkan iframe jika ada video
//         } else {
//             // Sembunyikan iframe jika tidak ada video
//             youtubePlayer.src = ''; // Reset URL iframe
//             youtubePlayer.style.display = 'none';
//         }
//     }
// }

// // Fungsi untuk mendapatkan ID video YouTube dari berbagai format URL
// function getYoutubeVideoId(videoLink) {
//     let videoId = '';
//     const url = new URL(videoLink);

//     if (url.hostname === 'youtu.be') {
//         // Jika URL menggunakan format youtu.be
//         videoId = url.pathname.substr(1);
//     } else if (url.hostname === 'www.youtube.com') {
//         // Jika URL menggunakan format www.youtube.com
//         if (url.searchParams.has('v')) {
//             videoId = url.searchParams.get('v');
//         } else {
//             videoId = url.pathname.substr(1);
//         }
//     }

//     return videoId;
// }


