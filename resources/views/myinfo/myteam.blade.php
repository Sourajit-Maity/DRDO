@extends('adminlte::page')
@section('content')
<link rel="icon" href="img/logo.png">
  <link rel="stylesheet" href="css/jquery.orgchart.min.css">
  <link rel="stylesheet" href="css/style.css">
 


<div id="chart-container"></div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.orgchart.js"></script>

<script type="text/javascript">
  'use strict';

(function($){

  $(function() {

    jQuery.ajax({ 
        url : 'my-team-view',
        type : "GET",
        dataType : "json",
        success:function(data)
        {
           data = JSON.parse(data);
           var datascource = data;

          $('#chart-container').orgchart({
            'data' : datascource,
            'depth': 1,
            'nodeTitle': 'name',
            'nodeContent': 'title',
            'nodeID': 'id',
            'createNode': function($node, data) {
              console.log("Dataaaaaaaaaaaaaaaaaaaaa",data.img);
              if(data.img==0){
                data.img='assets/images/dummy.png';
              }else{
                data.img='assets/images/'+data.img;
              }
              var nodePrompt = $('<i>', {
                'class': 'fa fa-info-circle second-menu-icon',
                click: function() {
                  $(this).siblings('.second-menu').toggle();
                }
              });
              var secondMenu = '<div class="second-menu"><img style="height:70px;" class="avatar" src="'+data.img+'"></div>';
              $node.append(nodePrompt).append(secondMenu);
            }
          });


        }
    });

    

    

  });

})(jQuery);
</script>

@include('footerimport')
@endsection