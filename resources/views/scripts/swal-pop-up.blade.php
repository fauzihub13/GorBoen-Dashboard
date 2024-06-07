@if(Session::has('error'))
    <script>
        $(document).ready(function() {
            var errorMessage = "{{ Session::get('error') }}";
            swalErrorMessage(errorMessage);
        });
    </script>
@endif

@if(Session::has('success'))
    <script>
        $(document).ready(function() {
            var successMessage = "{{ Session::get('success') }}";
            swalSuccessMessage(successMessage);
        });
    </script>
@endif


<script>
    function confirmDelete(event, itemId) {
        event.preventDefault(); // Menghentikan submit form secara default

        swal({
            title: "Anda yakin?",
            text: "Data yang dihapus tidak dapat dipulihkan kembali!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Jika pengguna mengonfirmasi, lanjutkan dengan submit form
                document.getElementById("deleteForm" + itemId).submit();
            } else {
                // Jika pengguna membatalkan, tidak melakukan apa pun
                swal("Data Anda aman tidak terhapus!");
            }
        });
    }
</script>

