
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Results</h1>
    </div>


  <!-- Testimonials -->
      <?php foreach($search_com as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title?></h5>
              <p class="card-text">
              <?php
              $string = array();
              $i = 0;
              foreach($authors as $name){
                if($row->publication_id == $name->publication_id){
                  if(isset($name->middle_initial)){
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                  }else{
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                  }
                  $i++;
                }
              }
            ?>
            <?php if(!empty($row->url)){ ?>
              <?php echo implode(', ', $string) ?> (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
              <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
            <?php }else{ ?>
              <?php echo implode(', ', $string) ?>
              (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
              <?php echo $row->location?>: <?php echo $row->institution?>.
            <?php } ?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php } ?>

      <?php foreach($search_pre as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_presented?></h5>
              <p class="card-text">
              <?php
              $string = array();
              $i = 0;
              foreach($authors as $name){
                if($row->publication_id == $name->publication_id){
                  if(isset($name->middle_initial)){
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                  }else{
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                  }
                  $i++;
                }
              }
              $date = date_create("$row->date_presentation");  
            ?>
            <?php echo implode(', ', $string) ?> (<?php echo date_format($date, "Y");?>, <?php echo date_format($date, "F");?>). <i><?php echo $row->title_presented;?></i>. Paper presented at the
            <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

      <?php foreach($search_pub as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <?php if($row->published_type == 'Journal Article'){ ?>
                <h5 class="card-title"><?php echo $row->title_article ?></h5>
              <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                <h5 class="card-title"><?php echo $row->title_book ?></h5>
              <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                <h5 class="card-title"><?php echo $row->title_chapter ?></h5>
              <?php }else{ ?>
                <h5 class="card-title"><?php echo $row->title_conference ?></h5>
              <?php } ?>
              <p class="card-text">
              <?php
                $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                    }else{
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                    }
                    $i++;
                  }
                }
                $string_ed = array();
                $x = 0;
                foreach($editors as $ed){
                  if($row->published_id == $ed->published_id){
                    if(isset($ed->editor_mi)){
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_mi . " " . $ed->editor_ln; 
                    }else{
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_ln; 
                    }
                    $x++;
                  }
                }  
              ?>
              <?php if($row->published_type == 'Journal Article'){ ?>
                <?php echo implode(', ', $string) ?>
                (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
                <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
                <?php echo $row->page_num; ?>.

              <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. 
                <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?>.

              <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
                <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
                <?php echo $row->publisher; ?>.

              <?php }else{ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
                (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
                <?php if(isset($row->url)){ ?>
                  .Retrieved from<?php echo $row->url; ?>
                <?php }else{ ?>.<?php } ?>

              <?php } ?>
              
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

      <?php foreach($search_cre as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_work?></h5>
              <p class="card-text">
              <?php if(isset($row->middle_initial)){ ?>
              <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->middle_initial?> <?php echo $row->last_name?>.
              <?php }else{ ?>
                <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->last_name?>.
              <?php } ?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

</div>
<!-- /.container-fluid -->