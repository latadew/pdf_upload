<!-- header start-->
<?php include 'include/header.php'; ?>
<!-- header end -->
<div class="container-fluid">
    <nav class="navbar navbar-default">
        <div class="row">
            <div class="col-md-3" style="background:#f5f5f5 !important">
                <div class="navbar-header">
                  <span class="navbar-brand" style="font-size: 14px;
    color: black;
    font-weight: 700;
}">FILES</span> 
                  <a class="navbar-brand" href="javascript:void(0);" style="font-size: 14px;
    float: right;">Upload</a>
                </div>
            </div>
            <div class="col-md-9" style="background:#438fd1 !important;">
                <ul class="nav navbar-nav">
                  <li><a href="javascript:void(0)" class="text-white" style="font-size: 17px;
    font-weight: 700;">Document #1</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Document #1 <br>
                        <span class="sub-text">Me Dustin</span></a></li>
                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Document #2 <br>
                        <span class="sub-text">Me Dustin</span></a></li>
                    <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Document #3 <br>
                        <span class="sub-text">Me Dustin</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <iframe src="assets/uploads/hd.pdf#toolbar=0" style="width:955px; min-height:500px; overflow-y: scroll;" frameborder="0"></iframe>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer start-->
<?php include 'include/footer.php'; ?>
<!-- footer end-->
