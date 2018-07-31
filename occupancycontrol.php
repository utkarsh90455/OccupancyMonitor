	<?php session_start();?>
	<!Doctype html>
	<html>
	<head>
		<title>Occupancy Monitor</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link href="css/glyphicons.css" rel="stylesheet">

		<!--<script src="assets/jquery-2.1.3.js"></script>-->
		
		<script src="js/jquery.js"></script>
		
		<script src="js/bootstrap.min.js" ></script>
		<!--<script src="code.js"></script>-->
		<script type="text/javascript" src="js/jqueryDatatables.js"></script>
		<script type="text/javascript" src="js/Datatablesfixedcol.js"></script>
		<script type="text/javascript">
			var year_check='';
			function auto_scroll(){
				$("#employe").mousemove(function(event){
					var currentX=event.pageX;
					var currentY=event.pageY-$(this).offset().top;
					//var a= $(this).offset().top;
	                 //var left = new pos($("#left").offset().left,$("#left").offset().top);
	                 //var right = new pos($("#right").offset().left,$("#right").offset().top);
	                 //var top = new pos($("#top").offset().left,$("#top").offset().top);
	                 //var bottom = new pos($("#down").offset().left,$("#down").offset().top);
	                //$("#type").text(" "+$(window).height()/currentY+" "+currentY/$('.dataTables_scrollBody').height()+" "+$('.dataTables_scrollBody').height()/currentY+" "+currentY+" "+a);
	       //alert(''+currentX+" "+currentY+" ");         
	       if(($(window).width()/2)<currentX){
	                   //var x=right.x/currentX;
	                   x=currentX/$(window).width()
	                   if(x>1){x=x/10;}
	                   x=x.toFixed(1);
	                   $("#right").css({'opacity':x,
	                   	'visibility':'visible'});
	               }
	               else{
	               	x=$(window).width()/currentX;
	               	if(x>2){ x=x/10;}

	               	x=x.toFixed(1);
	               	$("#left").css({'opacity':x,
	               		'visibility':'visible'});
	               }
	               if(($('.dataTables_scrollBody').height()/2)<currentY){
	               	y=currentY/$('.dataTables_scrollBody').height();
	               	if(y>2){y=y/10;}
	               	y=y.toFixed(1);
	               	$("#down").css({'opacity':y,
	               		'visibility':'visible'});
	               }
	               else{
	               	y=$('.dataTables_scrollBody').height()/currentY;
	               	if(y>2){ y=y/10;}
	               	y=y.toFixed(1);
	               	$("#top").css({'opacity':y,
	               		'visibility':'visible'});

	               }


	           });
	            //}); 
	            $('#right').click(function() {
	            	event.preventDefault();
	            	$(".lrtd").prop("disabled", true);
	            	var currentYear = new Date().getFullYear();
	            	$offset1=-17;
	            	$offset2=0;
	            	var leftPos = $('.dataTables_scrollBody').scrollLeft();
	            	//alert("1");
	            	//alert(" "+leftPos+"  "+$('.dataTables_scrollBody').get(0).scrollWidth+" "+$('.dataTables_scrollBody').width()+"  "+$('#employe').width()+" "+$('#parent').width()+" ");
	            	if(($offset1==($('#employe').width()-$('#parent').width()-leftPos))||($offset2==($('#employe').width()-$('#parent').width()-leftPos))){
	            		//alert("2");

	            		if((currentYear+1)==$("#year").val()){
                   	//alert("3");
                   	alert("Records Not Available!");
                   	$(".lrtd").prop("disabled", false);
                   }
                   else{
                   	// alert("4");
                   	$(".sk-circle").css('display','block');
                   	$('#year option:selected').removeAttr('selected').prev('option').attr('selected', 'selected');
                   	
                   	setTimeout(function(){
                   		$(".blank").css("opacity","0");
                   	},10)

                   	
                       //alert($('#year option:selected').val());  
                       request();
                       
                   }



               }else{
               	var scroll =$('.dataTables_scrollBody').get(0).scrollWidth - leftPos;
                   	//alert(" "+$('.dataTables_scrollBody').get(0).scrollWidth+" "+leftPos);
                   	$('.dataTables_scrollBody').animate({
                   		scrollLeft : scroll,
                   		opacity:0.2
                   	},10,'linear',function(){
                   		$(this).animate({
                   			opacity:1
                   		},1000);		
                   	});
                   	$(".lrtd").prop("disabled", false);
                   }


               });

	            $('#left').click(function() {
	            	event.preventDefault();

	            	$(".lrtd").prop("disabled", true);
	            	var leftPos = $('.dataTables_scrollBody').scrollLeft();
	            	if(leftPos==0){
	            		if($("#year").val()==2011){
	            			alert("Records Not Available!");
	            			$(".lrtd").prop("disabled", false);
	            		}else{
	            			//(" "+$("#year").val());
	            			$(".sk-circle").css('display','block');
	            			$('#year option:selected').removeAttr('selected').next('option').attr('selected', 'selected');
	            			//alert(" "+$("#year").val());
	            			setTimeout(function(){
	            				$(".blank").css("opacity","0");
	            			},10)
	            			
                       //alert($('#year option:selected').val());  
                       request();
                       

                   }

               }
               else{
               	$('.dataTables_scrollBody').animate({
               		scrollLeft : -leftPos,
               		opacity:0.2
               	},10, 'linear',function(){
               		$(this).animate({
               			opacity:1
               		},1000);	
               	});
               	$(".lrtd").prop("disabled", false);
               }
	      //var scroll = ($('#employe').width(); - rightPos);
	      //alert(''+$('#parent').width()+" "+rightPos+" ");
	      
	  });
	            $('#down').click(function() {
	            	event.preventDefault();
	            	var topPos = $('.dataTables_scrollBody').scrollTop();
	            	var scroll = $('.dataTables_scrollBody').height(); - topPos;
	      //alert(''+$('#employe').height()+" "+topPos+" ");
	      $('.dataTables_scrollBody').animate({
	      	scrollTop : scroll,
	      	opacity:0.2
	      },10, 'linear',function(){
	      	$(this).animate({
	      		opacity:1
	      	},1000);		
	      });
	  });
	            $('#top').click(function() {
	            	event.preventDefault();
	            	var topPos = $('.dataTables_scrollBody').scrollTop();
	      //var scroll = ($('#employe').width(); - topPos);
	      //alert(''+$('#parent').height+" "+rightPos+" ");
	      $('.dataTables_scrollBody').animate({
	      	scrollTop : -topPos,
	      	opacity:0.2
	      },10, 'linear',function(){
	      	$(this).animate({
	      		opacity:1
	      	},1000);		
	      });
	  });
	        }
	        $(window).on('load',function(){
	        	$(".sk-circle").css({"z-index":999,"display":"block"});
	  //$('#myOverlay').show();
	  var select = $("#year").val();
	  year_check=select;
	  $(window).resize(function() 
	  { 
	  	$('#left').css({
	  		'top':($(".dataTables_scrollBody").height()/2)

	  	}) 
	  	$('#right').css({
	  		'top':($(".dataTables_scrollBody").height()/2),
	  		'left':$(".dataTables_scrollBody").width()-13
	  	}) 
	  	$('#down').css({
	  		'top':$(".dataTables_scrollBody").height(),
	  		'left':$(".dataTables_scrollBody").width()/2
	  	})
	  	$('#top').css({
	  		'left':$(".dataTables_scrollBody").width()/2
	  	}) 

	  } );
	  $("#myBtn").click(function(){
	   	          // $("#myModal").modal({backdrop: 'static', keyboard: false});
	   	          $(".sk-circle").css('display','block');
	   	          if(year_check==$("#year").val())
	   	          {
	   	          	alert("Current Data is "+year_check+"'s Data !");
	   	          	$(".sk-circle").css('display','none');

	   	          }
	   	          else{
	   	          	//year_check=$("#year").val();
	   	          	setTimeout(function(){
	   	          		$(".blank").css("opacity","0");
                      //$(".blank").fadeOut(1000);
                  },10)

	   	          	request();


	   	          }
								//$(".sk-circle").slideDown().fadeIn();
                 //$(".blank").css("visibility","hidden");
             });
	    /*$("#test").click(function(){
	   	          // $("#myModal").modal({backdrop: 'static', keyboard: false});
								 $(".sk-circle").css('display','block');
								//$(".sk-circle").slideDown().fadeIn();
                 //$(".blank").css("visibility","hidden");
                 //request();
	          });
	    $("#test2").click(function(){
	   	          // $("#myModal").modal({backdrop: 'static', keyboard: false});
								 $(".sk-circle").css('display','none');
								//$(".sk-circle").slideDown().fadeIn();
                 //$(".blank").css("visibility","hidden");
                 //request();
             });*/

             $(".dis").prop("disabled", true);
             setTimeout(function(){
             	var tb= $("#employe").DataTable({
             		"dom": "t",
             		"paging":false,
             		"sScrollY": "35vh", 
             		scrollX:true,
             		fixedColumns:{
             			leftColumns:5
             			//rightColumns:1
             		}

             	});
	  		/*$('#myInput').keyup(function(){
                tb.search($(this).val()).draw() ;
            })*/


            $("[data-toggle='tooltip']").tooltip();
            $('#left').css({
            	'top':($(".dataTables_scrollBody").height()/2)

            }) 
            $('#right').css({
            	'top':($(".dataTables_scrollBody").height()/2),
            	'left':$(".dataTables_scrollBody").width()-13
            }) 
            $('#down').css({
            	'top':$(".dataTables_scrollBody").height(),
            	'left':$(".dataTables_scrollBody").width()/2
            })
            $('#top').css({
            	'left':$(".dataTables_scrollBody").width()/2
            }) 
            auto_scroll();
            $(".dis").removeAttr('disabled');
            $(".sk-circle").css('display','none');
            $("#hint").css('visibility','visible');
            $("#parent").css("visibility","visible");
        },1000);
             $("#parent").css({'display':'block','visibility':'hidden'});


         });


	        function request(){

	  //alert(""+$("#loader").css("display"));
	  var select = $("#year").val();
	  year_check=select;
	  //$('#myOverlay').show();visibility: hidden
	  $(".dis").prop("disabled", true);
	  $.ajax({  
	  	type: "POST",  
	  	url: "occupancycontrol_request.php",  
	  	data: {'year': select},  
	  	success: function(dataString) {
	        //$("#loader").fadeOut();
	        
	        $('#parent').html(dataString);
	        $(".blank").css("opacity","0");
	        //$("#employe").tableHeadFixer({"head" : true, "foot": false,"left": 5,"right":1}); 
	        /*$(".blank").css("visibility","visible");
	        $(".dis").removeAttr('disabled');
	        $('[data-toggle="tooltip"]').tooltip();
	        
	        $('#left').css({
	        	'top':$("#parent").height()/2,
	        	
	        }) 
	  		 $('#right').css({
	        	'top':$("#parent").height()/2,
	        	'left':$("#parent").width()-10
	        }) 
	  		 $('#down').css({
	        	'top':$("#parent").height()+20,
	        	'left':$("#parent").width()/2
	        })
	        $('#top').css({
	        	'left':$("#parent").width()/2
	        }) 
	        auto_scroll();
	        //show_hover();
	        //}); */
	        setTimeout(function(){
	        	var tb = $("#employe").DataTable({
	        		"dom": "t",
	        		"paging":false,
	        		"sScrollY":"35vh", 
	        		scrollX:true,
	        		fixedColumns:{
	        			leftColumns:5
	        			//rightColumns:1
	        		}
	        	});
	  		/*$('#myInput').keyup(function(){
                tb.search($(this).val()).draw() ;
            })*/
            $(".dis").removeAttr('disabled');
            $(".sk-circle").css("display","none");
            $(".blank").css("opacity","1");
            $("[data-toggle='tooltip']").tooltip();
            $('#left').css({
            	'top':($(".dataTables_scrollBody").height()/2),

            }) 
            $('#right').css({
            	'top':($(".dataTables_scrollBody").height()/2),
            	'left':$(".dataTables_scrollBody").width()-13
            }) 
            $('#down').css({
            	'top':$(".dataTables_scrollBody").height(),
            	'left':$(".dataTables_scrollBody").width()/2
            })
            $('#top').css({
            	'left':$(".dataTables_scrollBody").width()/2
            }) 
            auto_scroll();
            $(".sk-circle").css("display","none");
            $("#hint").css("visibility","visible");
        },1000);

	    }  
	});  
	  

	}
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body >
	<div class="sk-circle">
		<div class="sk-circle1 sk-child"></div>
		<div class="sk-circle2 sk-child"></div>
		<div class="sk-circle3 sk-child"></div>
		<div class="sk-circle4 sk-child"></div>
		<div class="sk-circle5 sk-child"></div>
		<div class="sk-circle6 sk-child"></div>
		<div class="sk-circle7 sk-child"></div>
		<div class="sk-circle8 sk-child"></div>
		<div class="sk-circle9 sk-child"></div>
		<div class="sk-circle10 sk-child"></div>
		<div class="sk-circle11 sk-child"></div>
		<div class="sk-circle12 sk-child"></div>
	</div>
	<div class="container-fluid">
		<!--<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>-->
		<div style="margin-top: 10px;">
			<center><h3 class="label label-info" style="font-size: 20px;background-color: #007AFF;">Occupancy Monitor</h3></center></div>
			<div style="margin-top: 5px;">

				<!-- <i class="material-icons prefix">date_range</i>-->
				<select name="year" id="year" class="select dis" >
					<?php 
					$curr_year= Date("Y");
					$next_year=$curr_year+1;
       //echo $d;
					echo '<option value="'.$next_year.'">'.$next_year.'</option>';
					echo '<option value="'.$curr_year.'" selected >'.$curr_year.'</option>';
					$curr_year--;
					while($curr_year>=2011){
						echo '<option value="'.$curr_year.'" >'.$curr_year.'</option>';
						$curr_year--;
					}
					?>
			<!--<option value="2019">2019</option>
				<option value="2018" selected >2018</option>
				<option value="2017">2017</option>
				<option value="2016">2016</option>
				<option value="2015">2015</option>
				<option value="2014">2014</option>
				<option value="2013">2013</option>
				<option value="2012">2012</option>
				<option value="2011">2011</option>-->
			</select>
			<!--<div id="type"></div>-->
<!--<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>-->

<button type="button" name="submit" class="btn btn-primary mybtn dis" id="myBtn">Submit<span style="margin-left: 5px;"class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
<div class="inner-addon right-addon" style="width: 280px;height: 15px;float: right;font-size: 10px;">
	<i class="glyphicon glyphicon-search"></i>
	<input id="myInput" type="text" class="form-control" placeholder="Search... " />
</div>

</div>
<!--<input id="myInput" class="form-control" type="text" style="width:320px;height:25px;  float: right" placeholder="Search..">-->
<div id="parent">
	<?php 
	include_once('includes/config.inc.php');
	require('occupancycontrol_function.php');
	$con= new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE)or die("Could not connect to mysql".mysqli_error($con));

	$default_year=Date("Y");
	$query=" SELECT name,EmployeeID,DOJ,DOR,modeOfEmployment,TLWD FROM  `employees` WHERE DOR IS NULL ORDER BY modeOfEmployment ";
	$result = mysqli_query($con, $query);
	$records = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	//$_SESSION['records']=$records;
	echo '
	<button type="button" class="btn btn-primary lrtd" id="left"><i  class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true" style="text-align: center;"></i></button>
	<button type="button" class="btn btn-primary lrtd" id="right"><i  class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="text-align: center;"></i></button>
	<button type="button" class="btn btn-primary lrtd" id="top"><i  class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true" style="text-align: center;"></i></button>
	<button type="button" class="btn btn-primary lrtd" id="down"><i  class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true" style="text-align: center;"></i></button>
	<table align="center"  class=" table-bordered" id="employe" style="border:none;" >

	<thead class="tb-head" >	
	<tr class="text">
	<th rowspan="3" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">Sl.&nbsp;No.</th>
	<th rowspan="3" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">Emp.&nbsp;Id.</th>
	<th rowspan="3" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">Name</th>
	<th rowspan="3" style="background:#007AFF;color: white;font-size: 10px;
	border-bottom:none;border-top:none;text-align:center;">I/P</th>
	<th rowspan="3" style="background:#007AFF;color: white;font-size: 10px;
	border-bottom:none;border-top:none;text-align:center;">DOJ</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">Jan</th>

	<th style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;" colspan=
	'; ?><?php if($default_year%4==0){
		echo "29";
	}
	else{
		echo "28";
	}?><?php
	echo '>Feb</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">March</th>
	<th colspan="30" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">April</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">May</th>
	<th colspan="30" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">June</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">July</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">August</th>
	<th colspan="30" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">September</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">October</th>
	<th colspan="30" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;border-top:none;text-align:center;">Novemember</th>
	<th colspan="31" style="background:#007AFF;color: white;font-size: 10px;border-bottom:none;text-align:center;">December</th>
	</tr>
	<tr>';
	
	  //$left=count($records)-$count; 
	for($j=1;$j<=12;$j++){
		$days=0;
		$days=getDays($j,$default_year);
		for($i=1;$i<=$days;$i++){
			
			if($i==1){
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border-right:none;border-top:none;border-bottom:none;,border-left:white;text-align:center;' >".$i."</th>";
			}
			else if($i==$days){
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border-left:none;border-top:none;border-bottom:none;,border-right:white;text-align:center;'>".$i."</th>";
			}
			else{
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border:none;text-align:center;' >".$i."</th>";
			}

			
			
		}
	}
	echo "</tr><tr>";
	for($j=1;$j<=12;$j++){
		$days=0;
		$days=getDays($j,$default_year);
		for($i=1;$i<=$days;$i++){
			$count=0;
         //echo count($records);
			foreach ($records as $row) {
				$temp_DOJ=explode("-", $row['DOJ']);
				if($temp_DOJ[0]<=$default_year){  
					if(empty($row['TLWD'])){$r="2090-12-31";}
					else{$r=$row['TLWD'];}
					$dj=date_create($row['DOJ']);
					$dtlwd=date_create($r);
					$cd=date_create($default_year."-".$j."-".$i);
					$diff1=date_diff($dj,$cd);
					$diff2=date_diff($cd,$dtlwd);
					if($diff1->format("%R%a")>=0&&$diff2->format("%R%a")>=0){
						$count++;
					}
				}
			}

			
			if($i==1){
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border-right:none;border-top:none;border-bottom:none;,border-left:white;text-align:center;' ><div data-toggle='tooltip' data-placement='auto' title='"."PF:&nbsp;".$count."'>".$count."</div></th>";
			}
			else if($i==$days){
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border-left:none;border-top:none;border-bottom:none;,border-right:white;text-align:center;'><div data-toggle='tooltip' data-placement='auto' title='"."PF:&nbsp;".$count."' >".$count."</div></th>";
			}
			else{
				echo "<th  style='background:#007AFF;color: white;font-size:8px;font-weight: normal;border:none;text-align:center;' ><div data-toggle='tooltip' data-placement='auto' title='"."PF:&nbsp;".$count."'>".$count."</div></th>";
			}

			
			
		} 
	}





	
	echo '</tr></thead><tbody>';
	?>

	<?php
	$z=1;
//if ($result = mysqli_query($con, $query)) {
	//echo $result;
  //while ($row = mysqli_fetch_assoc($result)){

	foreach ($records as $row) {
  //var_dump($records);
		$temp= array();
		$temp=explode(" ",$row['name']);
		$temp_DOJ=explode("-", $row['DOJ']);
		if($temp_DOJ[0]<=$default_year){  
			if(empty($temp[1])){$temp[1]=" "; }
			
			$id=substr($row['EmployeeID'], 4);
			echo "<tr><td class='side_content' style='border:none;'>".$z."</td><td class='side_content' style='border:none;'>".$id."</td><td class='side_content' style='text-align:left;border:none;' title='".$row['name']."''>".$temp[0]." ".$temp[1][0]."</td>";
			if(!strcmp($row['modeOfEmployment'],"Intern")){
				$modeOfEmployment="I";
				echo "<td class='side_content' style='border:none;background:#aab7f5;color:#fff;'>".$modeOfEmployment."</td><span>";
			}
			else{
				$modeOfEmployment="P";
				echo "<td class='side_content' style='border:none;background:#80d27f;color:#fff;' >".$modeOfEmployment."</td>";
			}

			$temp_DOJ=explode("-", $row['DOJ']);
			if($temp_DOJ[2][0]=='0'){$temp_DOJ[2]=  $temp_DOJ[2][1];}
			echo "<td class='side_content' style='border:none;text-align:right;'>".$temp_DOJ[2]." ".getmonth($temp_DOJ[1])." ".$temp_DOJ[0]."</td>";

			if(empty($row['TLWD'])){$r="2090-12-31";}
			else{$r=$row['TLWD'];}
       //echo $row['name'].$DOR[0];
			$dj=date_create($row['DOJ']);
			$dtlwd=date_create($r);

			for($j=1;$j<=12;$j++){
				$days=0;
				$days=getDays($j,$default_year);

				for($i=1;$i<=$days;$i++){
					$cd=date_create($default_year."-".$j."-".$i);
					$diff1=date_diff($dj,$cd);
					$diff2=date_diff($cd,$dtlwd);
					if($diff1->format("%R%a")>=0&&$diff2->format("%R%a")>=0){

						if($i==$days)
						{

							echo "<td  class='blank' style='border-right:2px solid #007AFF;' ><div data-toggle='tooltip' data-placement='auto' title='".$row['name'].", ".$i." ".getmonth($j)." ".$default_year."' class='"."success_".$modeOfEmployment." tip' >"."</div></td>";
						}
						else{
							echo "<td  class='blank' ><div data-toggle='tooltip' data-placement='auto' title='".$row['name'].", ".$i." ".getmonth($j)." ".$default_year."' class='"."success_".$modeOfEmployment." tip' >"."</div></td>";
						}
					}
					else{


      //check_print($row['name'],$i,$j,$default_year,"danger_".$modeOfEmployment,$days);
						if($i==$days)
						{

							echo "<td  class='blank' style='border-right:2px solid #007AFF;' ><div data-toggle='tooltip' data-placement='auto' title='".$row['name'].", ".$i." ".getmonth($j)." ".$default_year."' class='"."danger_".$modeOfEmployment." tip' >"."</div></td>";
						}
						else{
							echo "<td  class='blank' ><div data-toggle='tooltip' data-placement='auto' title='".$row['name'].", ".$i." ".getmonth($j)." ".$default_year."' class='"."danger_".$modeOfEmployment." tip' >"."</div></td>";
						}


					}
				}
			}
		/*if(empty($row['DOR'])){
			echo "<td class='side_content' style='border:none;' >-";
		}
		else{
			echo "<td class='side_content' style='border:none;' >";
			$temp_DOR=explode("-", $row['DOR']);
			if($temp_DOR[2][0]=='0'){$temp_DOR[2]=$temp_DOR[2][1];}
			echo $temp_DOR[2]." ".getmonth($temp_DOR[1])." ".$temp_DOR[0];
		}*/
		echo "</tr>";
		$z=$z+1;
	}
}

echo '</tbody></table>';
?>
<center><div id="hint" style="margin-top: 3px;visibility: hidden;"><div style="display:inline-block;background-color: #80d27f;height: 20px; width:20px;"></div><span class="txt" ><p>Permanent, Filled</p></span>
	<div style="display:inline-block;background-color: #aab7f5;height: 20px; width:20px;"></div><span class="txt"><p>Intern, Filled</p></span>
	<div style="display:inline-block;background-color: #e6cccc;height: 20px; width:20px;"></div><span class="txt"><p>Position, Empty</p></span>
</div></center>
</div>





</div>
<!--<button type="button" id="test">test1</button>
	<button type="button" id="test2">test2</button>-->
	<script>
		$(document).ready(function(){
			$("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#employe tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
				$(".DTFC_LeftWrapper .DTFC_LeftBodyWrapper .DTFC_LeftBodyLiner tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
				/*$(".DTFC_RightWrapper .DTFC_RightBodyWrapper .DTFC_RightBodyLiner tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});*/

			});

		});


	</script>
</body>
</html>