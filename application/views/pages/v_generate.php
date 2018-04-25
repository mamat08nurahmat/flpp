<script type="text/javascript">
    $(function(){
        $("#btnCari").click(function() {
            var $form = $('#laporanPage').find('form'),
                $month = $("#month").val(),
                $year = $("#year").val(),
              //$kd_user = $("#kd_user").val(),
                $url = $form.attr('action');
            $.ajax({
                type: "POST",
                url: $url,
                dataType: "html",
//                data: "tgl_awal="+$tgl_awal+"&tgl_akhir="+$tgl_akhir,
                  data: "month="+$month+"&year="+$year,
                cache:false,
                success: function(data){
                    $(".loader").fadeIn(500).fadeOut(500).queue(function(){
                        $('#result').html(data);
                    });
                }
            });
            return false;
        });
    });
</script>

<h3 style="text-align: center">
</h3>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span4">&nbsp;</div>
        <div class="span4 loader" style="text-align: center">
            <div class="progress progress-striped active" style="display: none">
                <div class="bar" style="width: 100%;"></div>
            </div>
        </div>
        <div class="span4">&nbsp;</div>
    </div>

    <div style="border-bottom: 1px #999 dashed; margin-bottom: 20px"></div>

    <div class="row-fluid">
        <div id="laporanPage">
		
<?php
/*
*/

//print_r($no_ktp);
/*
*/
$linksz = array(
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
''.base_url().'' ,
''.base_url().'' 

);
//print_r($linksz);die();
$links = $data_link;



$open = '';
foreach ($links as $link) {
  $open .= "setTimeout('window.open('{$link}','_blank');,5000');";	
//$open .="setTimeout('window.location = 'http://www.google.com';,5000');";	
/ //  $open .= "window.open('{$link}','_blank'); ";
//$open .="document.write('Generate...');";	
//document.write("Generate...");
//setTimeout('window.location = "http://www.google.com";,5000');	
}

echo "<a href=\"#\" onclick=\"{$open}\">
<button  class='btn btn-info'><i class='icon icon-white icon-search'></i> GENERATE</button>

</a>";
/*
*/

?>	
		
<!---
            <form class="form-horizontal" method="post" action="<?= site_url('report/get_generate_batch')?>">
                <div class="control-group">
                    <label class="control-label" for="start_date">Batch Upload</label>
                    <div class="controls">

                        <select id="batch_id" tabindex="5" class="chzn-select" name="batch_id" data-placeholder="Pilih Titik">
                            <option value=""></option>
                            <?php
                            if(isset($data_upload)){
                                foreach($data_upload as $row){
//$no_ktp=array($row->NO_KTP_PEMOHON);
									
                                    ?>
                                    <option value="<?php echo $row->NO_KTP_PEMOHON;?>"><?php echo $row->NO_KTP_PEMOHON;?> </option>
                                <?php
                                }
                            }
                            ?>
                        </select>

					
					
                    </div>
                </div>
	
	
				
                <div class="control-group">
                    <div class="controls">
                        <button id="btnCari" type="submit" class="btn btn-info"><i class="icon icon-white icon-search"></i> GENERATE</button>
                    </div>
                </div>
            </form>

-->		

			</div>
    </div>
    <div style="border-bottom: 1px #999 dashed; margin-bottom: 20px"></div>

    <div class="row-fluid">
        <div id="result"></div>
    </div>

</div>


