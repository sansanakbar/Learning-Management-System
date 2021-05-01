
    <script>
        $(document).ready(function(){
            $('#pilihjenisakun').change(function(){
                if($(this).val() == 1){
                    $('#pilihmapel').show();
                    $('#pilihkelas').hide();
                }
                else if($(this).val() == 2){
                    $('#pilihkelas').show();
                    $('#pilihmapel').hide();
                }
            })
        }); 
    </script>
