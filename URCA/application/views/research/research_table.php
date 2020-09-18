
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">My Research</h1>
  <a href="<?php echo base_url('research/add');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
  <i class="fas fa-download fa-sm text-white-50"></i> Add Research</a>
</div>
         
<!-- Completed Research -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Completed Research</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php
      foreach($completed_research as $row){ ?>
      <td><a href="<?php echo base_url('research/edit/'.$row->publication_id);?>">
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
        </a></td>
      <?php }else{ ?>
        <?php echo implode(', ', $string) ?>
        (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
        <?php echo $row->location?>: <?php echo $row->institution?>.
      <?php } ?>
      </a></td><hr/>
    <?php } ?>
    </div>
  </div>
</div>
<!-- end of Completed Research -->

<!-- Presented Research -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Presented Research</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php
      foreach($presented_research as $row){ ?>
    <td><a href="<?php echo base_url('research/edit/'.$row->publication_id);?>">
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
        <?php echo implode(', ', $string) ?> (<?php echo $row->date_presentation;?>). <i><?php echo $row->title_presented;?></i>. Paper presented at the
        <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
        </a></td><br/><br/>
    <?php } ?>
    </div>
  </div>
</div>
<!-- end of Presented Research -->

<!-- Published Research -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Published Research</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php foreach($published_research as $row){ ?>
      <td>
        <a href="<?php echo base_url('research/edit/'.$row->publication_id);?>">
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
          <?php if($row->published_type == 'Journal Article'){ ?>
            <?php echo implode(', ', $string) ?>
            (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
            <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
            <?php echo $row->page_num; ?>.

          <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. 
            <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?>.

          <?php }elseif($row->published_type == 'Book Chapter'){ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>.
            <i><?php echo $row->title_book; ?></i> (<?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
            <?php echo $row->publisher; ?>.

          <?php }else{ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <?php echo $row->place_of_conference; ?> 
            (<?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
            <?php if(isset($row->url)){ ?>
              .Retrieved from<?php echo $row->url; ?>
            <?php }else{ ?>.<?php } ?>

          <?php } ?>
        </a>
      </td>
      <br /><br />
    <?php } ?>
    </div>
  </div>
</div>
<!-- end of Published Research -->

<!-- Creative Works Research -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Creative Works</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php foreach($creative_research as $row){ ?>
      <td>
        <a href="<?php echo base_url('research/edit/'.$row->publication_id);?>">
          <?php if(isset($row->middle_initial)){ ?>
            <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->middle_initial?> <?php echo $row->last_name?>.
          <?php }else{ ?>
            <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->last_name?>.
          <?php } ?>
        </a>
      </td>
      <br />
    <?php } ?>
    </div>
  </div>
</div>
<!-- end of Creative Works Research -->
