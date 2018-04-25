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
            <form class="form-horizontal" method="post" action="<?= site_url('laporan/cari_detail')?>">
			
                <div class="control-group">
                    <label class="control-label" for="start_date">Bulan Upload</label>
                    <div class="controls">
					
<select name="month" >
<option value="1" >Januari</option>
<option value="2" >Februari</option>
<option value="3" >Maret</option>
<option value="4" >April</option>
<option value="5" >Mei</option>
<option value="6" >Juni</option>
<option value="7" >Juli</option>
<option value="8" >Agustus</option>
<option value="9" >September</option>
<option value="10" >Oktober</option>
<option value="11" >November</option>
<option value="12" >Desember</option>
</select>
					
					
                    </div>
                </div>
				
				
                <div class="control-group">
                    <label class="control-label" for="start_date">Tahun Upload</label>
                    <div class="controls">
					
<select name="year" >
<option value="2016" >2016</option>
<option value="2017" >2017</option>
<option value="2018" >2018</option>
</select>
					
					
                    </div>
                </div>				
				
				
                <div class="control-group">
                    <div class="controls">
                        <button id="btnCari" type="submit" class="btn btn-info"><i class="icon icon-white icon-search"></i> Search...</button>
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
