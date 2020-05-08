<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<div class="container">
    <h2>Publication</h2>
    <div class="form-group">
        <div class="input-group">
            <input type="text" name="keyword" id="keyword" class="form-control" />
        </div>
    </div>
    <br />
    <div id="result"></div>
</div>

<script>
    $(document).ready(function(){
        load_data();

    function load_data(query){
        $.ajax({
            url: "<?php echo base_url(); ?>research/search",
            method: "POST",
            data: {query:query},
            success:function(data){
                $('#result').html(data);
            }
        })
    }

    $('#keyword').keyup(function(){
        var search = $(this).val();
        if(search != ''){
            load_data(search);
        }else{
            load_data();
        }
    });
    });
</script>
