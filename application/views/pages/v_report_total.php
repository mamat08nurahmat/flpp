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
            <form class="form-horizontal" method="post" action="<?= site_url('report/get_total')?>">
                <div class="control-group">
                    <label class="control-label" for="start_date">Batch Upload</label>
                    <div class="controls">

<!--manual-->					
<select name="batch_id" >
<option value="001" >001</option>
<option value="002" >002</option>
<option value="003" >003</option>
</select>

					
					
                    </div>
                </div>
				

				
                <div class="control-group">
                    <div class="controls">
                        <button id="btnCari" type="submit" class="btn btn-info"><i class="icon icon-white icon-search"></i> GENERATE</button>
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


