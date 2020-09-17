    <!--
    <script>
        var i = 0;
        var original = document.getElementById('dup');
            function duplicate(){
                var clone = original.cloneNode(true);
                clone.id = "dup" + ++i;
                original.parentNode.appendChild(clone);
            }
    </script>
        <script>
$(document).ready(function(){
   $("#but").click(function(){
      $("#dup").clone().appendTo("body");
   });
});
</script>
        -->
        <script>
            $(document).ready(function(){
                var html ='<tr><td><input type="text" name="first_name[]" class="form-control"></td><td><input type="text" name="middle_initial[]" class="form-control"></td><td><input type="text" name="last_name[]" class="form-control"></td><td><input class="btn btn-danger"type="button" id="remove" name="remove" value="Remove"></td></tr>';

                var x = 1;
                $("#Addition").click(function(){
                    $("#table_author").append(html);
                });
                $("#table_author").on('click','#remove',function(){
                    $(this).closest('tr').remove();
                });
            });
        </script>
        <script>
            function myFunction{
                alert("Hello there");
            }
        </script>

        <button onclick="alertFunction()">Alert</button>
        <form method="post" action="<?php echo base_url()?>research/completed_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div id="add">
        <input type='number' style="display:none" name="research_type" value='1'></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_author">
                <tr>
                    <th>First Name</th>
                    <th>Middle Initial(s)</th>
                    <th>Last Name</th>
                    <th>Add/Remove</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="last_name[]" class="form-control">
                    </td>
                    <td>
                    <input class="btn btn-primary" type="button" id="Addition" name="Addition" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" name="year" class="form-control">
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of thesis / dissertation*</label>
                <input type="text" name="title" class="form-control">
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>URL for published thesis</label>
                <input type="text" name="url" class="form-control">
                <span class="text-danger"><?php echo form_error("url");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" name="institution" class="form-control">
            <span class="text-danger"><?php echo form_error("institution");?></span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="location" class="form-control">
            <span class="text-danger"><?php echo form_error("location"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" name="file" class="form-control-file">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>

