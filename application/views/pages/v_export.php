<script type="text/javascript">
/*
    $(function(){
        $("#btnCari").click(function() {
            var $form = $('#laporanPage').find('form'),
                $tgl_awal = $("#tgl_awal").val(),
                $tgl_akhir = $("#tgl_akhir").val(),
                $url = $form.attr('action');
            $.ajax({
                type: "POST",
                url: $url,
                dataType: "html",
                data: "tgl_awal="+$tgl_awal+"&tgl_akhir="+$tgl_akhir,
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
*/
	
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
            <form class="form-horizontal" method="post" action="<?= site_url('excel_export/fleksi_cabang_all')?>">
<!---
                <div class="control-group">
                    <label class="control-label" for="start_date">Start Date</label>
                    <div class="controls">
					
                        <select id="batch_id" tabindex="5" class="chzn-select" name="batch_id" data-placeholder="Pilih Titik">
                            <option value=""></option>
                            <?php
                            if(isset($data_upload)){
                                foreach($data_upload as $row){
                                    ?>
                                    <option value="<?php echo $row->batch_id?>"><?php echo $row->batch_id?> </option>
                                <?php
                                }
                            }
                            ?>
                        </select>
					
					
                    </div>
                </div>
--->			
				
                <div class="control-group">
                    <div class="controls">
                        <button id="btnCari" type="submit" class="btn btn-info"><i class="icon icon-white icon-search"></i> fleksi_cabang_all</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="border-bottom: 1px #999 dashed; margin-bottom: 20px"></div>

    <div class="row-fluid">
        <div id="result"></div>
    </div>

</div>

<!--
       <form action="action">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="text" name="tanggal" class="tanggal" />
            </div>
        </form>


<script type="text/javascript" src="<?php //echo base_url('asset/js/jquery.min.2.0.2.js')?>"></script> 
-->

<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/js/bootstrap.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('asset/datepicker/js/bootstrap-datepicker.js')?>"></script> 
		
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tanggal').datepicker({
                    //format: "dd-mm-yyyy",
                    format: "mm/dd/yyyy",
                    autoclose:true
                });
            });
        </script>
