<!DOCTYPE html>
<html>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>


<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $("#div1").load("report/get_batch", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                alert("External content loaded successfully!");
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
});
</script>
</head>
<body>


<h2>Month</h2></div>
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
<h2>Year</h2></div>
<select name="year" >
<option value="2016" >2016</option>
<option value="2017" >2017</option>
<option value="2018" >2018</option>
</select>

<button>Generate</button>


<div id="div1">




</body>
</html>
