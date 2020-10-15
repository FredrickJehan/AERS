    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Research</h1>
    </div>

    <div class="card shadow mb-4">
    <div class="card-body">

    <!-- Submittion form -->
    <form method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Type of Research/Creative Work</label>
            <select id="researchID" name="research" onchange="displayForm(this)" class="form-control">
                <option>Select</option>
                <option>Thesis / Dissertation</option>
                <option>Technical / Research Report</option>
                <option>Conference Paper</option>
                <option>Conference Poster</option>
                <option>Journal Article</option>
                <option>Book / Textbook</option>
                <option>Book Chapter</option>
                <option>Conference Proceedings</option>
                <option>Creative Work</option>
            </select>
        </div>
        <!--
        <div class="form-group col-md-4">
            <label>Current Academic Rank</label>
            <input type="text" class="form-control" value="Professor 3" disabled>
        </div>
        -->
    </div>
    </form>


    <hr>
    <!-- ./End of Submittion form -->

    <?php foreach($user_data as $row){ ?>
    <!-- Creative form -->
    <div id="creative" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/creative_submit" enctype="multipart/form-data">
        <a style="display:none" name="research_type" value='9'></a>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
            </div>
            <div class="form-group col-md-2">
                <label>M.I.(S)*</label>
                <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
            </div>
            <div class="form-group col-md-5">
                <label>Lastname*</label>
                <input type="text" name="last_name[]" value="<?php echo $row->last_name?>" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label>Type of Research/Creative Work*</label>
            <select class="form-control" name="type" required>
                <option>Select</option>
                <option value="Art Work">Art Work</option>
                <option value="Film">Film</option>
                <option value="Photography">Photography</option>
                <option value="Software Application">Software Applicaiton</option>
                <option value="Graphic Design">Graphic Design</option>
                <option value="Theatre">Theatre</option>
                <option value="Dance">Dance</option>
                <option value="Performance">Performance</option>
                <option value="Mural">Mural</option>
                <option value="Specify">Specify</option>
            </select>
            </div>
            <div class="form-group col-md-6">
                <label>Month and/or Year performed / exhibited / published*</label>
                <input type="date" name="month_year" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Title of Work*</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label>Role*</label>
                <input type="text" name="role" placeholder="(e.g. Director, Actor, Translator)" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label>Place of performance / publication / exhibition*</label>
                <input type="text" name="place" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">  
                <label>Producer / Organizer / Publisher</label>
                <input type="text" name="publisher" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Number of artworks exhibited (if applicable)</label>
                <input type="number" name="exhibited" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Duration of performance / exhibition</label>
                <input type="text" name="duration" placeholder="(e.g. One-Act play, Full-length film)" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Scope of audience*</label>
                <select name="scope" class="form-control" required>
                    <option>Select</option>
                    <option value="Institutional">Institutional</option>
                    <option value="Regional">Regional</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Commissioning agency (if applicable)</label>
                <input type="text" name="comm" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Award received (if applicable)</label>
                <input type="text" name="award" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Documentation (e.g., photos / videos / CD) of the creative work or its
exhibition / performance*
            </label>
            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Creative form -->

    <!-- Thesis / Dissertation form -->
    <!--Script for multiple authors -->       
    <div id="thesis" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/completed_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <input type='text' style="display:none" name="research_type" value='Thesis / Dissertation'></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_thesis">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_thesis" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" name="year" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of thesis / dissertation*</label>
                <input type="text" name="title" class="form-control" required>
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
            <input type="text" name="institution" class="form-control" required>
            <span class="text-danger"><?php echo form_error("institution");?></span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="location" class="form-control" required>
            <span class="text-danger"><?php echo form_error("location"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Thesis / Dissertation form -->

    <!-- Technical / Research form -->
    <div id="technical" style="display:none;">
    <form method="post" action="<?php echo base_url()?>research/completed_submit" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <input type='text' style="display:none" name="research_type" value='Technical / Research Report'></input>
        <div class="form-row">
        <table class="table table-borderless" id="table_technical">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_technical" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" name="year" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-10">
                <label>Title of Report*</label>
                <input type="text" name="title" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label>Institution where report was completed*</label>
                <input type="text" name="institution" class="form-control" required>
                <span class="text-danger"><?php echo form_error("institution");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Location of Institute*</label>
                <input type="text" name="location" class="form-control" required>
                <span class="text-danger"><?php echo form_error("location");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file: Copy of full technical report*</label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Technical / Research form -->

    <!-- Conference Paper form -->
    <div id="conference" style="display:none;">
    <form method="post" action="<?php echo base_url()?>research/presented_submit" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <input type='text' style="display:none" name="research_type" value='Conference Paper'></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_conference">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_conference" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Year completed*</label>
                <input type="month" name="month_year" class="form-control" required>
                <span class="text-danger"><?php echo form_error("month_year");?></span>
            </div>
            <div class="form-group col-md-8">
                <label>Title of paper*</label>
                <input type="text" name="title" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-8">
            <label>Full title of conference*</label>
            <input type="text" name="title_conference" class="form-control" required>
            <span class="text-danger"><?php echo form_error("title_conference");?></span>
        </div>
        <div class="form-group col-md-4">
            <label>Place of conference*</label>
            <input type="text" name="place_conference" class="form-control" required>
            <span class="text-danger"><?php echo form_error("place_conference");?></span>
        </div>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file (jpg or pdf): Copy of Certificate of Presentation</label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Paper form -->

    <!-- Conference Poster form -->
    <div id="poster" style="display:none;">
    <form method="post" action="<?php echo base_url()?>research/presented_submit" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <input type='text' style="display:none" name="research_type" value='Conference Poster'></input>
        <div class="form-row">
        <table class="table table-borderless" id="table_poster">
            <tr>
                <th>First Name*</th>
                <th>Middle Initial(s)*</th>
                <th>Last Name*</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                    <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                </td>
                <td>
                    <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                    <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                </td>
                <td>
                    <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                    <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                </td>
                <td>
                    <input class="btn btn-primary" type="button" id="add_poster" name="Add" value="Add">
                </td>
            </tr>
        </table>
        </div>
        <!--
        <div class="form-group">
            <div class="btn-author">
                <input type='button' value='Add Author' class='fas fa-user d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'>
            </div>
        </div>
        -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Year completed*</label>
                <input type="month" name="month_year" class="form-control" required>
                <span class="text-danger"><?php echo form_error("month_year");?></span>
            </div>
            <div class="form-group col-md-8">
                <label>Title of Poster*</label>
                <input type="text" name="title" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-8">
            <label>Full title of conference*</label>
            <input type="text" name="title_conference" class="form-control" required>
            <span class="text-danger"><?php echo form_error("title_conference");?></span>
        </div>
        <div class="form-group col-md-4">
            <label>Place of conference*</label>
            <input type="text" name="place_conference" class="form-control" required>
            <span class="text-danger"><?php echo form_error("place_conference");?></span>
        </div>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of poster, picture of presenter with poster as background and/or Certificate of Poster Presentation
            </label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- End of Conference Poster form -->

    <!-- Journal Article form -->
    <div id="journal" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <input type='text' style="display:none" name="research_type" value="Journal Article"></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_journal">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th>Is Employee?</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="employee[]" class="form-control" id="employee">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="employee[]" id="inlineRadio1" value=1 checked>
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="employee[]" id="inlineRadio2" value=0>
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div> -->
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_journal" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Published*</label>
                <input type="number" name="year" min="1800" max="2099" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of Article*</label>
                <input type="text" name="title_article" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of Journal</label>  
                <input type="text" name="title_journal" class="form-control">
                <span class="text-danger"><?php echo form_error("title_journal");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Volume Number*</label>
                <input type="number" name="vol_num" class="form-control" required>
                <span class="text-danger"><?php echo form_error("vol_num");?></span>
            </div>
            <div class="form-group col-md-4">
                <label>Issue Number</label>
                <input type="number" name="issue_num" class="form-control">
                <span class="text-danger"><?php echo form_error("issue_num");?></span>
            </div>
            <div class="form-group col-md-4">
                <label>Page Number*</label>  
                <input type="text" name="page_num" class="form-control" required>
                <span class="text-danger"><?php echo form_error("page_num");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>Indexing Databse*</label>
                <select class="form-control" name="type" required>
                    <option value="None">None</option>
                    <option value="Scopus">Scopus</option>
                    <option value="Web Science">Web Science</option>
                    <option value="ASEAN Citation Index">ASEAN Citation Index</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label>Peer-review*</label>
                <br />  
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="yes_peer" name="peer" value="yes" class="custom-control-input">
                    <label class="custom-control-label" for="yes_peer">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="no_peer"name="peer" value="no" class="custom-control-input">
                    <label class="custom-control-label" for="no_peer">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of original article submitted, Copy of peer-review, Copy of full published paper*
            </label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Journal Article form -->
    

    <!-- Book / Textbook form -->
    <div id="book" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <input type='text' style="display:none" name="research_type" value="Book / Textbook"></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_book">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th>Is Employee?</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="employee[]" class="form-control" id="employee">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_book" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Year Published*</label>
                <input type="number" name="year" min="1800" max="2099" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-9">
                <label>Title of Book/Textbook/anthology*</label>
                <input type="text" name="title_book" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title_book");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Publisher*</label>
                <input type="text" name="publisher" class="form-control" required>
                <span class="text-danger"><?php echo form_error("publisher");?></span>
            </div>  
        </div>
        <div class="form-row">
        <div class="form-group col-md-12">
                <label>Place of Publication*</label>
                <input type="text" name="place" class="form-control" required>
                <span class="text-danger"><?php echo form_error("place");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, copyright page, table of contents, about the author(s) page*
            </label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Book / Textbook form -->

    <!-- Book Chapter form -->
    <div id="chapter" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <input type='text' style="display:none" name="research_type" value="Book Chapter"></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_bookchap">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th>Is Employee?</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="employee[]" class="form-control" id="employee">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_bookchap" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Published*</label>
                <input type="number" name="year" min="1800" max="2099" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of Chapter*</label>
                <input type="text" name="title_chapter" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title_chapter");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of Book*</label>
                <input type="text" name="title_book" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title_book");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>Editor*</label>
        </div>
        <div class="form-row">
            <table class="table table-borderless" id="table_bookchap_ed">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="editor_fn[]"  class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_fn[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="editor_mi[]"  class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_mi[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="editor_ln[]" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_ln[]");?></span>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_bookchap_ed" name="add_ed" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Page Numbers*</label>
                <input type="text" name="page_num" class="form-control" required>
                <span class="text-danger"><?php echo form_error("page_num");?></span>
            </div>
            <div class="form-group col-md-10">
                <label>Publisher*</label>
                <input type="text" name="publisher" class="form-control" required>
                <span class="text-danger"><?php echo form_error("publisher");?></span>
            </div>  
        </div>
        <div class="form-row">
        <div class="form-group col-md-12">
                <label>Place of Publication*</label>
                <input type="text" name="place" class="form-control" required>
                <span class="text-danger"><?php echo form_error("place");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: CCopy of front page of the book, copyright page, table of contents,
                Copy of peer-review, Copy of full chapter published in the edited book*
            </label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Book Chapter form -->

    <!-- Conference Proceedings form -->
    <div id="proceedings" style="display:none;">
        <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <input type='text' style="display:none" name="research_type" value="Conference Proceedings"></input>
        <div class="form-row">
            <table class="table table-borderless" id="table_conproc">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th>Is Employee?</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name[]" value="<?php echo $row->first_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="middle_initial[]" value="<?php echo $row->middle_name?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="last_name[]" value="<?php echo $row->last_name?> "class="form-control" required>
                        <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="employee[]" class="form-control" id="employee">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_conproc" name="Add" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Published*</label>
                <input type="number" name="year" min="1800" max="2099" class="form-control" required>
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of Article*</label>
                <input type="text" name="title_article" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title_article");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Full Title of Conference*</label>
                <input type="text" name="title_conference" class="form-control" required>
                <span class="text-danger"><?php echo form_error("title_conference");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Place of Conference(City & Country)*</label>
                <input type="text" name="place_con" class="form-control" required>
                <span class="text-danger"><?php echo form_error("place_con");?></span>
            </div>
            <div class="form-group col-md-6">
                <label>Publisher*</label>
                <input type="text" name="publisher" class="form-control" required>
                <span class="text-danger"><?php echo form_error("publisher");?></span>
            </div>  
        </div>
        <div class="form-group">
            <label>Editor*</label>
        </div>
        <div class="form-row">
            <table class="table table-borderless" id="table_conproc_ed">
                <tr>
                    <th>First Name*</th>
                    <th>Middle Initial(s)*</th>
                    <th>Last Name*</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="editor_fn[]"  class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_fn[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="editor_mi[]"  class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_mi[]");?></span>
                    </td>
                    <td>
                        <input type="text" name="editor_ln[]" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("editor_ln[]");?></span>
                    </td>
                    <td>
                        <input class="btn btn-primary" type="button" id="add_conproc_ed" name="Add_ed" value="Add">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Page Number*</label>
                <input type="text" name="page_num" class="form-control" required>
                <span class="text-danger"><?php echo form_error("page_num");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Place of Publication*</label>
                <input type="text" name="place" class="form-control" required>
                <span class="text-danger"><?php echo form_error("place");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>URL(if published online, no need to submit file)</label>
                <input type="text" name="url" class="form-control">
                <span class="text-danger"><?php echo form_error("url");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page of conference proceedings, copyright page, table
of contents, copy of peer-review, copy of published conference proceedings
            </label>
            <input type="file" name="file" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" placeholder="Type here your abstract" rows="5" ></textarea>
        </div>
        <div class="form-group" style="text-align:center;">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Proceedings form -->

        <?php } ?>
    </div>
    </div>
    <!-- ./end of table form-->
<script>
    function displayForm(researchType){

        if(researchType.value == "Thesis / Dissertation"){
            document.getElementById('thesis').style.display = "block";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Technical / Research Report"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "block";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Conference Paper"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "block";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Conference Poster"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "block";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Select"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Journal Article"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "block";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Book / Textbook"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "block";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Book Chapter"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "block";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Conference Proceedings"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "block";
            document.getElementById('creative').style.display = "none";
        } else if (researchType.value == "Creative Work"){
            document.getElementById('thesis').style.display = "none";
            document.getElementById('technical').style.display = "none";
            document.getElementById('conference').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('journal').style.display = "none";
            document.getElementById('book').style.display = "none";
            document.getElementById('poster').style.display = "none";
            document.getElementById('chapter').style.display = "none";
            document.getElementById('proceedings').style.display = "none";
            document.getElementById('creative').style.display = "block";
        } 
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //html
        //<div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline1" class="custom-control-input"><label class="custom-control-label">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline2" class="custom-control-input"><label class="custom-control-label">No</label></div>
        var thesis ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_thesis" name="remove" value="Remove"></td></tr>';
        var technical ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_technical" name="remove" value="Remove"></td></tr>';
        var conference ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_conference" name="remove" value="Remove"></td></tr>';
        var poster ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_poster" name="remove" value="Remove"></td></tr>';
        var journal = '<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><div class="form-group"><select name="employee[]" class="form-control" id="employee"><option value="1">Yes</option><option value="0">No</option></select></div></td><td><input class="btn btn-danger" type="button" id="remove_journal" name="Remove" value="Remove"></td></tr>';
        var booktext = '<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><div class="form-group"><select name="employee[]" class="form-control" id="employee"><option value="1">Yes</option><option value="0">No</option></select></div></td><td><input class="btn btn-danger" type="button" id="remove_booktext" name="Remove" value="Remove"></td></tr>';
        var bookchap = '<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><div class="form-group"><select name="employee[]" class="form-control" id="employee"><option value="1">Yes</option><option value="0">No</option></select></div></td><td><input class="btn btn-danger" type="button" id="remove_bookchap" name="Remove" value="Remove"></td></tr>';
        var bookchap_ed = '<tr><td><input type="text" name="editor_fn[]"  class="form-control" required></td><td><input type="text" name="editor_mi[]"  class="form-control" required></td><td><input type="text" name="editor_ln[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_bookchap_ed" name="remove_ed" value="Remove"></td></tr>'
        var conference_proceedings = '<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><div class="form-group"><select name="employee[]" class="form-control" id="employee"><option value="1">Yes</option><option value="0">No</option></select></div></td><td><input class="btn btn-danger" type="button" id="remove_conproc" name="Remove" value="Remove"></td></tr>';
        var conference_proceedings_ed = '<tr><td><input type="text" name="editor_fn[]"  class="form-control" required></td><td><input type="text" name="editor_mi[]"  class="form-control" required></td><td><input type="text" name="editor_ln[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_conproc_ed" name="remove_ed" value="Remove"></td></tr>'

        var min = 1;
        var max = 9;
        var min_ed = 1;
        var max_ed = 9;

        //add buttons
        $("#add_thesis").click(function(){
            if(min <= max){
                $("#table_thesis").append(thesis);
                min++;
            }
        });
        $("#add_technical").click(function(){
            if(min <= max){
                $("#table_technical").append(technical);
                min++;
            }
        });
        $("#add_conference").click(function(){
            if(min <= max){
                $("#table_conference").append(conference);
                min++;
            }
        });
        $("#add_poster").click(function(){
            if(min <= max){
                $("#table_poster").append(poster);
                min++;
            }
        });
        $("#add_journal").click(function(){
            if(min <= max){
                $("#table_journal").append(journal);
                min++;
            }
        });
        $("#add_book").click(function(){
            if(min <= max){
                $("#table_book").append(booktext);
                min++;
            }
        });
        $("#add_bookchap").click(function(){
            if(min <= max){
                $("#table_bookchap").append(bookchap);
                min++;
            }
        });
        $("#add_bookchap_ed").click(function(){
            if(min_ed <= max_ed){
                $("#table_bookchap_ed").append(bookchap_ed);
                min_ed++;
            }
        });
        $("#add_conproc").click(function(){
            if(min <= max){
                $("#table_conproc").append(conference_proceedings);
                min++;
            }
        });
        $("#add_conproc_ed").click(function(){
            if(min_ed <= max_ed){
                $("#table_conproc_ed").append(conference_proceedings_ed);
                min_ed++;
            }
        });

        //remove buttons
        $("#table_thesis").on('click','#remove_thesis',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_technical").on('click','#remove_technical',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_conference").on('click','#remove_conference',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_poster").on('click','#remove_poster',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_journal").on('click','#remove_journal',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_book").on('click','#remove_booktext',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_bookchap").on('click','#remove_bookchap',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_bookchap_ed").on('click','#remove_bookchap_ed',function(){
            $(this).closest('tr').remove();
            min_ed--;
        });
        $("#table_conproc").on('click','#remove_conproc',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_conproc_ed").on('click','#remove_conproc_ed',function(){
            $(this).closest('tr').remove();
            min_ed--;
        });
    });
</script>
