<?php 
    foreach($home_data as $row)
?>
<div class="container">
    <h4 class="my-4">Detailed Paper</h4>
    
    <!-- Table of Submitees -->
        <table class="table table-bordered ">
        </tbody>
            <tr>
                <td width="200"><b>Author Name</b></td>
                <td><?php echo $row->cr_author?></td>
            </tr>
            <tr>
                <td width="200"><b>Title of research</b></td>
                <td><?php echo $row->cr_title?></td>
            </tr>
            <tr>
                <td width="200"><b>Date Published</b></td>
                <td><?php echo $row->cr_year?></td>
            </tr>
            <tr>
                <td width="200"><b>Email</b></td>
                <td>knolan@gbox.adnu.edu.ph</td>
            </tr>
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td>In Marxist thought, communist society or the communist system is the type of 
                society and economic system postulated to emerge from technological advances in 
                the productive forces, representing the ultimate goal of the political ideology 
                of communism. A communist society is characterized by common ownership of the means 
                of production with free access[1][2] to the articles of consumption and is classless 
                and stateless,[3] implying the end of the exploitation of labour.[4][5]</td>
            </tr>
        </tbody>
        </table>

        <div class="form-group" style="text-align:left;">
            <a href="<?php echo base_url("/homepage")?>" class="btn btn-primary">Go back</a>
        </div>
</div>