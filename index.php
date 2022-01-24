<!-- header start-->
<?php include 'include/header.php'; ?>
<!-- header end -->
<div class="container-fluid">
    <nav class="navbar navbar-default">
        <div class="row">
            <div class="col-md-3" style="background:#f5f5f5 !important">
                <div class="navbar-header">
                    <form id="formID" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="file" name="files" placeholder="FILES" accept="application/pdf" class="form-control file-type-style" required="required" />
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="navbar-brand btn-style" href="javascript:void(0);" style="">Upload <i class="fa fa-upload"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9" style="background:#438fd1 !important;">
                <ul class="nav navbar-nav">
                  <li><a href="javascript:void(0)" class="text-white fs-17 fw-700"><span id="docNameID"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div id="alertMsg"></div>
        </div>
    </div>
    <div id="divDocID"></div>
</div>
<!-- footer start-->
<?php include 'include/footer.php'; ?>
<!-- footer end-->
