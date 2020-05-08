
<!-- Begin Page Content -->
<div class="container-fluid">

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
                <option>Technical / Research report</option>
                <option>Conference Paper</option>
                <option>Conference Poster</option>
                <option>Journal Article</option>
                <option>Book / Textbook</option>
                <option>Book Chapter</option>
                <option>Conference Proceedings</option>
                <option>Creative Work</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Current Academic Rank</label>
            <input type="text" class="form-control" value="Professor 3" disabled>
        </div>
    </div>
    </form>

    <hr>
    <!-- ./End of Submittion form -->

    <!-- Creative form -->
    <div id="creative" style="display:none;">
        <form>
        <div class="form-row">
            <div class="form-group col-md-5">
            <label>Creator</label>
            <label>First Name*</label>
            <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-2">
            <label>Middle Initial(s)*</label>
            <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
            <label>Last Name*</label>
            <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label>Type of Research/Creative Work</label>
            <select class="form-control">
                <option>Select</option>
                <option>Art Work</option>
                <option>Film</option>
                <option>Photography</option>
                <option>Software Applicaiton</option>
                <option>Graphic Design</option>
                <option>Theatre</option>
                <option>Dance</option>
                <option>Performance</option>
                <option>Mural</option>
                <option>Specify</option>
            </select>
            </div>
            <div class="form-group col-md-6">
                <label>Month and/or Year performed / exhibited / published*</label>
                <input type="number" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Title of Work</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Role*</label>
                <input type="text" placeholder="(e.g. Director, Actor, Translator)" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Place of performance / publication / exhibition*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Producer / Organizer / Publisher</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Duration of performance / exhibition</label>
                <input type="text" placeholder="(e.g. One-Act play, Full-length film)" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Number of artworks exhibited (if applicable)</label>
                <input type="number" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Scope of audience*</label>
                <select class="form-control">
                    <option>Select</option>
                    <option>Institutional</option>
                    <option>Regional</option>
                    <option>International</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Commissioning agency (if applicable)</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Award received (if applicable)</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Documentation (e.g., photos / videos / CD) of the creative work or its
exhibition / performance*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        </form>
    </div>
    <!-- ./Creative form -->

    <!-- Thesis / Dissertation form -->
    <div id="thesis" style="display:none;">
        <form method="post" action="<?php echo base_url()?>insert/completed_form_validation" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
            <label>First Name*</label>
            <input type="text" name="thesisFirst" class="form-control" required>
            <span class="text-danger"><?php echo form_error("thesisFirst"); ?>
            </span>
            </div>
            <div class="form-group col-md-2">
            <label>Middle Initial(s)*</label>
            <input type="text" name="thesisMiddle" class="form-control" required>
            <span class="text-danger"><?php echo form_error("thesisMiddle"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>Last Name*</label>
            <input type="text" name="thesisLast" class="form-control" required>
            <span class="text-danger"><?php echo form_error("thesisLast"); ?>
            </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year Completed*</label>
            <input type="number" name="thesisYear" class="form-control" required>
            <span class="text-danger"><?php echo form_error("thesisYear"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>Title of thesis / dissertation*</label>
            <input type="text" name="thesisTitle" class="form-control" required>
            <span class="text-danger"><?php echo form_error("thesisTitle"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>URL for published thesis</label>
            <input type="text" name="thesisURL" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisURL"); ?>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" name="thesisInstitute" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisInstitute"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="thesisLocation" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisLocation"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" name="thesisFile" class="form-control-file">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="thesissubmit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Thesis / Dissertation form -->

    <!-- Technical / Research form -->
    <div id="technical" style="display:none;">
    <form method="post" action="<?php echo base_url()?>insert/technical_form_validation" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="technicalFirst" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalFirst");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="technicalMiddle" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalMiddle");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="technicalLast" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalLast");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" name="technicalYear" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalYear");?></span>
            </div>
            <div class="form-group col-md-10">
                <label>Title of Report*</label>
                <input type="text" name="technicalTitle" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalTitle");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label>Institution which commissioned the report / where report was completed*</label>
                <input type="text" name="technicalInstitute" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalInstitute");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Location of Institute*</label>
                <input type="text" name="technicalLocation" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalLocation");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file: Copy of full technical report*</label>
            <input type="file" name="technicalFile" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="technicalsubmit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Technical / Research form -->

    <!-- Conference Paper form -->
    <div id="conference" style="display:none;">
    <form method="post" action="<?php echo base_url()?>insert/conpaper_form_validation" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="conpaperFirst" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperFirst");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="conpaperMiddle" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperMiddle");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="conpaperLast" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperLast");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year completed*</label>
                <input type="text" name="conpaperYear" placeholder="ex. 2020" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperYear");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Month completed*</label>
                <input type="text" name="conpaperMonth" placeholder="ex. March" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperMonth");?></span>
            </div>
            <div class="form-group col-md-8">
                <label>Title of paper*</label>
                <input type="text" name="conpaperTitle" class="form-control">
                <span class="text-danger"><?php echo form_error("conpaperTitle");?></span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
            <label>Full title of conference*</label>
            <input type="text" name="conpaperFull" class="form-control">
            <span class="text-danger"><?php echo form_error("conpaperFull");?></span>
        </div>
        <div class="form-group col-md-6">
            <label>Place of conference*</label>
            <input type="text" name="conpaperPlace" class="form-control">
            <span class="text-danger"><?php echo form_error("conpaperPlace");?></span>
        </div>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file (jpg or pdf): Copy of Certificate of Presentation</label>
            <input type="file" name="conpaperFile" class="form-control-file">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="conpapersubmit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Paper form -->

    <!-- Conference Poster form -->
    <div id="poster" style="display:none;">
    <form method="post" action="<?php echo base_url()?>insert/conposter_form_validation">
        <div class="form-group">
            <label>Author*</label>
            <input type="text" name="conposterAuthor" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterAuthor"); ?>
            </span>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year completed*</label>
            <input type="text" name="conposterYear" value="ex. 2020" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterYear"); ?>
            </span>
            </div>
            <div class="form-group col-md-2">
            <label>Month completed*</label>
            <input type="text" name="conposterMonth" value="ex. March" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterMonth"); ?>
            </span>
            </div>
            <div class="form-group col-md-8">
            <label>Title of paper*</label>
            <input type="text" name="conposterTitle" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterTitle"); ?>
            </span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
            <label>Full title of conference*</label>
            <input type="text" name="conposterFull" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterFull"); ?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label>Place of conference*</label>
            <input type="text" name="conposterPlace" class="form-control">
            <span class="text-danger"><?php echo form_error("conposterPlace"); ?>
            </span>
        </div>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file (jpg or pdf): Copy of Certificate of Presentation
            </label>
            <input type="file" name="research_pdf" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="conpostersubmit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Poster form -->

    <!-- Journal Article form -->
    <div id="journal" style="display:none;">
    <form>
        <div class="form-row">
            <label>List the author/s of the article in the order they appear in the citation</label>
            <div class="form-group col-md-8">
                <label>Author 1*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 1 an employee of ADNU? </label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">No</label>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 2*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 2 an employee of ADNU? </label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add Author</a><br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Volume Number*</label>
                <input type="number" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Title of Article*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Title of Journal*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Indexing database*</label>
                <select class="form-control">
                    <option>Select</option>
                    <option>Scopus</option>
                    <option>Web of Science</option>
                    <option>ASEAN Citation Index</option>
                    <option>None</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Issue Number</label>
                <input type="text" class="form-control"/>
            </div>
            <div class="form-group col-md-3">
                <label>Page Numbers*</label>
                <input type="text" class="form-control"/>
            </div>
            <div class="form-group col-md-3">
                <label>Peer-Review*</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of original article submitted, Copy of peer-review, Copy of full
published paper*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <a href="#" class="btn btn-primary">Submit</a>
        </div>
    </form>
    </div>
    <!-- ./Journal Article form -->
    

    <!-- Book / Textbook form -->
    <div id="book" style="display:none;">
    <form>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 1*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 1 an employee of ADNU? </label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">No</label>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 2*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 2 an employee of ADNU? </label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add Author</a><br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Published*</label>
                <input type="number" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Title of Book/Textbook/Anthology*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Publisher*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <label>Place of Publication</label>
            <input type="text" class="form-control"/>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of front page, copyright page, table of contents, about the
author(s) page*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <a href="#" class="btn btn-primary">Submit</a>
        </div>
    </form>
    </div>
    <!-- ./Book / Textbook form -->

    <!-- Book Chapter form -->
    <div id="chapter" style="display:none;">
    <form>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 1*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 1 an employee of ADNU? </label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">No</label>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 2*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 2 an employee of ADNU? </label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add Author</a><br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year Published*</label>
            <input type="number" min="1900" max="2099" step="1" class="form-control"/>
            </div>
            <div class="form-group col-md-5">
            <label>Title of Chapter*</label>
            <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
            <label>Title of Book*</label>
            <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label>Editor(s): (First, Middle Initial(s), Last)*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Place of Conference*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Page Numbers*</label>
                <input type="number" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Publisher*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Place of Publication*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of front page of the book, copyright page, table of contents,
Copy of peer-review, Copy of full chapter published in the edited book*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <a href="#" class="btn btn-primary">Submit</a>
        </div>
    </form>
    </div>
    <!-- ./Book Chapter form -->


    <!-- Conference Proceedings form -->
    <div id="proceedings" style="display:none;">
    <form>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 1*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 1 an employee of ADNU? </label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">No</label>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Author 2*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-mid-4">
            <label>Is Author 2 an employee of ADNU? </label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add Author</a><br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year Published*</label>
            <input type="number" min="1900" max="2099" step="1" class="form-control"/>
            </div>
            <div class="form-group col-md-5">
            <label>Title of Article*</label>
            <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
            <label>Full Title of Conference*</label>
            <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label>Editor(s): (First, Middle Initial(s), Last)*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Place of Conference*</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Page Numbers*</label>
                <input type="number" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Publisher*</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>URL (if published online)</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of front page of conference proceedings, copyright page, table
of contents, copy of peer-review, copy of published conference proceedings
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <a href="#" class="btn btn-primary">Submit</a>
        </div>
    </form>
    </div>
    <!-- ./Conference Proceedings form -->

    </div>
    </div>
    <!-- ./end of table form-->

</div>
<!-- /.container-fluid -->
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
        } else if (researchType.value == "Technical / Research report"){
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
