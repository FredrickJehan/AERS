<?php 
    foreach($research_detailed as $row)
?>
<div class="container">
    <h4 class="my-4">Detailed Paper</h4>
    
    <!-- Table of Submitees -->
        <table class="table table-bordered ">
        </tbody>
            <tr>
                <td width="200"><b>Author Name</b></td>
                <td><?php echo $row->last_name?>, <?php echo $row->first_name?> <?php echo $row->middle_name?></td>
            </tr>
            <tr>
                <td width="200"><b>Title of research</b></td>
                <td><?php echo $row->title?></td>
            </tr>
            <tr>
                <td width="200"><b>Date Published</b></td>
                <td><?php echo $row->year?></td>
            </tr>
            <tr>
                <td width="200"><b>Email</b></td>
                <td><?php echo $row->email?></td>
            </tr>
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
        </tbody>
        </table>

        <div class="form-group" style="text-align:left;">
            <a href="<?php echo base_url()?>" class="btn btn-primary">Go back</a>
        </div>
</div>