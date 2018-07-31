<?php 
session_start();
/*include_once('dbConnection.php');
require('function.php');
//$_POST['year']=2018;
$query=" SELECT name,EmployeeID,DOJ,DOR,modeOfEmployment FROM  `employees` limit 50";
$result = mysqli_query($con, $query);*/
require('occupancycontrol_function.php');
include_once('includes/config.inc.php');
if(isset($_POST['year'])){
  $con= new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE)or die("Could not connect to mysql".mysqli_error($con));
  $query=" SELECT name,EmployeeID,DOJ,DOR,modeOfEmployment,TLWD FROM  `employees` WHERE DOR IS NULL ORDER BY modeOfEmployment ";
  $result = mysqli_query($con, $query);
  $records = mysqli_fetch_all ($result, MYSQLI_ASSOC);
  $default_year=$_POST['year'];
//$records = $_SESSION['records'];

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
         //echo count($records);
      

    } 
  }
  echo '</tr><tr>';
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
  if(empty($temp[1])){$temp[1]=" "; }
  if($temp_DOJ[0]<=$default_year){  
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
      //check_print($row['name'],$i,$j,$default_year,"success_".$modeOfEmployment,$days);
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
echo "</td></tr>";
$z=$z+1;
}
}

echo '</tbody></table><center><div id="hint" style="margin-top: 3px;visibility: hidden;"><div style="display:inline-block;background-color: #80d27f;height: 20px; width:20px;"></div><span class="txt" ><p>Permanent, Filled</p></span>
<div style="display:inline-block;background-color: #aab7f5;height: 20px; width:20px;"></div><span class="txt"><p>Intern, Filled</p></span>
<div style="display:inline-block;background-color: #e6cccc;height: 20px; width:20px;"></div><span class="txt"><p>Position, Empty</p></span>
</div></center>';
}
else{
  echo "Error found in loading !";
}
?>