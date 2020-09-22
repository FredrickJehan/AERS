<div class="d-md-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">View</h1>
</div>

<div class="card shadow mb-4">
<div class="card-body">
  <?php
    if($publication_type == 'Completed Research'){
        foreach($research_data as $row){
            if($row->completed_type == 'Thesis / Dissertation'){?>
        <!-- Thesis / Dissertation form -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title?></td>
            </tr>
            <tr>
                <td width="200"><b>Author Name</b></td>
                <td><?php echo $row->last_name?>, <?php echo $row->first_name?> <?php echo $row->middle_initial?></td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
    <!-- ./Thesis / Dissertation form -->

        <?php
            }else if($row->completed_type == 'Technical / Research Report'){?>
    <!-- Technical / Research form -->
    <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title?></td>
            </tr>
            <tr>
                <td width="200"><b>Author Name</b></td>
                <td><?php echo $row->last_name?>, <?php echo $row->first_name?> <?php echo $row->middle_initial?></td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
    <!-- ./Technical / Research form -->
        <?php }   
        }
    }else if($publication_type == 'Presented Research'){
        foreach($research_data as $row){
            if($row->presented_type == 'Conference Paper'){ ?>
    <!-- Conference Paper form -->
    <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_presented?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- ./Conference Paper form -->

        <?php
            }else if($row->presented_type == 'Conference Poster'){ ?>
    <!-- Conference Poster form -->
    <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_presented?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- ./Conference Poster form -->
        <?php }  } 

    }else if($publication_type == 'Published Research'){
        foreach($research_data as $row){
            if($row->published_type == 'Journal Article'){ ?>
        <!-- Journal Article form -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_article?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
        <!-- ./Journal Article form -->
            <?php 
            }else if($row->published_type == 'Book / Textbook'){ ?>
        <!-- Textbook form -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_article?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
        <!-- ./Textbook form -->
            <?php 
            }else if($row->published_type == 'Book Chapter'){ ?>
        <!-- Chapter form -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_article?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
        <!-- ./Chapter form -->
            <?php 
            }else{ ?>
        <!-- Proceedings form -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_article?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
        <!-- ./Proceedings form -->
            <?php 
            }
        }
        
    }else{
        foreach($research_data as $row){ ?>
        <!-- Creative Work form-->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title_work?></td>
            </tr>
            <tr>
            <td width="200"><b>Authors Name</b></td>
            <td>
            <?php foreach($author_data as $name){ 
                if($row->publication_id == $name->publication_id){ ?>
                    <?php echo $name->last_name?>, <?php echo $name->first_name?> <?php echo $name->middle_initial?>&nbsp
            <?php } } ?>
            </td>
            </tr>  
            <tr>
                <td width="200"><b>Abstract</b></td>
                <td><?php echo $row->abstract?></td>
            </tr>
            <tr>
                <td>
               <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Download PDF</a>
                </td>
            </tr>
        </tbody>
        </table>
        <!-- ./Creative Work form-->
        <?php 
    } }
?>
</div>
</div>