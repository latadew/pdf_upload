<?php

require_once ('../include/database.php');
$database = new Database(); //object created for database class
$db = $database->getConnection();

$pdfList = array();
$sql = "SELECT 
    d.file,
    d.file_name,
    d.status,
    d.created_date,
    u.user_name
    FROM documents d
    INNER JOIN users u ON d.created_by = u.id 
    GROUP BY d.id";
$stmt = $db->prepare($sql);
$stmt->execute();
$pdfList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12">
        <div class="vertical-tab" role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php
                    foreach ($pdfList as $key => $row){
                        $active = ($key==0) ? 'active' : '';
                    ?>
                        <li role="presentation" class="<?=$active;?>" onclick="change_name('<?=$row["file_name"]?>')"><a href="#Section<?=$key?>" class="data_<?=$active;?>" data-value="<?=$row['file_name']?>" aria-controls="home" role="tab" data-toggle="tab"><?=$row['file_name']?><br>
                        <span class="sub-text"><?=$row['user_name']?></span></a></li>
                    <?php
                    }
                ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabs">
                <?php
                    foreach ($pdfList as $key => $row){
                        $active = ($key==0) ? 'active' : '';
                    ?>
                        <div role="tabpanel" class="tab-pane fade in <?=$active;?>" id="Section1">
                            <iframe src="assets/uploads/<?=$row['file']?>#toolbar=0" style="width:955px; min-height:500px; overflow-y: scroll;" frameborder="0"></iframe>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>