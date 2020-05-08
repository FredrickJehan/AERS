<div class="container">
<br />
    <h2>Advance Search</h2>
    <div class="table-responsive">
    <table class="table">
        <tr>
            <td>
                <select name="type" class="form-control" id="type">
                    <option>Type of Research Work</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </td>
        </tr>
    </table>
    </div>

    <div class="table-responsive">
    <table class="table table-borderless" id="table2">
        <thread>
            <tr>
                <th>Citation</th>
            </tr>
        </thread>
        <tbody>
        <?php foreach($test as $row){ ?>
            <tr>
                <td>
                    <?php echo $row->last_name?>, <?php echo substr($row->first_name, 0, 1);?>. <?php echo $row->middle_initial?>
                    (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                    <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</div>
        
<script>
    $(document).ready(function()){
        $("#type").change(function(){
            let a = $(this).val();
        });
    });

    function advance() {
        var type = $(#type).val();
        $.ajax(){
            url: "<?= base_url('research/load_advance') ?>",
            data: "type=" + type,
            success:function(data){
                $("#table2 tbody").html
            }
        }
    }
</script>

<!-- <div class="container">
<br />  
        <form action="" method="POST">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name: </label>
                <input type="text" class="form-control" name="first_name" />
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial: </label>
                <input type="text" class="form-control" name="middle_initial" />
            </div>
            <div class="form-group col-md-5">
                <label>Last Name: </label>
                <input type="text" class="form-control" name="last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <select name="department" class="form-control">
                    <option>Department</option>
                    <option>Department of Computer Studies</option>
                    <option>Department of ajsdkfljjl</option>
                    <option>Department of sadsadasdasda</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <select name="type" class="form-control">
                    <option>Type of Research Work</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>From: </label>
                <input type="number" min="1900" max="2030" class="form-control" name="from_date" id="from" />
            </div>
            <div class="form-group col-md-2">
                <label>To: </label>
                <input type="number" min="1900" max="2030" class="form-control" name="to_date" id="to" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="submit" class="btn btn-primary"/>
            </div>
        </div>
        </form>
</div> -->