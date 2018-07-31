<?php
function getDays($j,$year){
                if($j==2){
                        if($year%4==0){return 29;}
                        else{return 28;} 
                 }
                else{
                    if($j<8){
                        if($j%2==0){return 30;}
                        else{return 31;}
                    }
                    else{
                        if($j%2==0){ return 31;}
                        else{return 30;}
                        }
                }   
}
function getmonth($month){
    switch ($month) {
    	case '1':
    		# code...
    		return "Jan";
    	case '2':
    		# code...
    		return "Feb";
    	case '3':
    		# code...
    		return "Mar";
    	case '4':
    		# code...
    		return "Apr";
    	case '5':
    		# code...
    		return "May";
    	case '6':
    		# code...
    		return "Jun";
    	case '7':
    		# code...
    		return "Jul";
    	case '8':
    		# code...
    		return "Aug";
    	case '9':
    		# code...
    		return "Sep";
    	case '10':
    		# code...
    		return "Oct";
        case '11':
    		# code...
    		return "Nov";
    	case '12':
    		# code...
    		return "Dec";
    	default:
    		# code...
    		return "error";
    }

}

/*
function check_print($name,$day,$month,$year,$class,$days){
      
            //$id=uniqid();
            if($day==$days)
            {
                
              echo "<td  class='blank' style='border-right:2px solid #007AFF;' ><div data-toggle='tooltip' data-placement='right' title='".$name.", ".$day." ".getmonth($month)." ".$year."' class='".$class." tip' >"."</div></td>";
            }
            else{
              echo "<td  class='blank' ><div data-toggle='tooltip' data-placement='right' data-original-title='".$name.", ".$day." ".getmonth($month)." ".$year."'  class='".$class." tip' >"."</div></td>";
            }

}*/


?>