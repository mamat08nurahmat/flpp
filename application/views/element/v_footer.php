<hr>
<div class="footer">
<!---
<p>&copy;  by : <a href="#" target="_blank"><strong>MATT</strong></a></p>
-->

</div>

<script type="text/javascript" src="<?php echo base_url('asset/js/jquery.printPage.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $(".btnPrint").printPage();
    })
	
	yepnope({ /* included with Modernizr */
  test : Modernizr.inputtypes.date,
  nope : {
    'css': '/path-to-your-css/jquery-ui-1.10.3.custom.min.css',
    'js': '/path-to-your-js/jquery-ui-1.10.3.datepicker.min.js'
  },
  callback: { // executed once files are loaded
    'js': function() { $('input[type=date]').datepicker({dateFormat: "yy-mm-dd"}); } // default HTML5 format
  }
});
	
	
</script>

    </div>
</body>