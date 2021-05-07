        <p>Footer</p>
        

        <script type="text/javascript">
            function ShowHideDiv() {
                var jenisAkun = document.getElementById("jenisAkun");
                var guruInputField = document.getElementById("guruInputField");
                var siswaInputField = document.getElementById("siswaInputField");
                guruInputField.style.display = jenisAkun.value == 1 ? "block" : "none";
                siswaInputField.style.display = jenisAkun.value == 2 ? "block" : "none";
            }
        </script>

        <!--<script>
            $(document).ready(function(){
                $('#lihatGuruModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var nama = button.data('nama');
                $('nama').val(nama);
                })
            })
        </script>-->

        <!--<script>
            var modal = document.getElementById("lihatGuruModal");
            var btn = document.getElementById("lihatGuruBtn");
            var span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>-->
    </body>
</html>