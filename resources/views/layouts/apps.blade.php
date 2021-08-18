<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
      $(".only-numeric").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      });
    });
     
</script>
<style>
.panel{
  border:1px solid #bbb;
  margin-bottom:20px !important;
}
.pull-left{
	float:left !important;
}
.pull-right{
	float:right !important;
}
.clear{
	clear:both !important;
}
.br_none
{
  display:block !important;
  border-radius:0px !important;
}
.p_body{
  height:250px;
  overflow-y:auto;
}

</style>


