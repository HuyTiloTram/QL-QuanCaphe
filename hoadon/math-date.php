<?php
if(isset($_POST['Finddate'])){
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $now=time();
  $datenow=getdate($now);
  if($datenow['wday']==0) $datenow['wday']=7;
  if($_POST['Finddate']=='Tuantruoc'){
  if ($datenow['mday']-$datenow['wday']-6 >0)
    {$thang2=$datenow['mon'];$ngay2=$datenow['mday']-$datenow['wday'];
    $thang1=$thang2;$ngay1=$ngay2-7+1;}
  else
  {
    $thang=$datenow['mon'];$mday= $datenow['mday'];$wday=['wday'];
    if( ($thang==1) || ($thang==3) || ($thang==5) || ($thang==7) || ($thang==8) || ($thang==10) || ($thang==12) )
      $maxmonth=31;
    elseif($thang==2)
      $maxmonth=28;
    else
      $maxmonth=30;
    $thang2=$thang-1;$ngay2=$maxmonth-(7-$wday);
    $thang1=$thang2;$ngay1=$ngay2-6;
  }
  }
  if($_POST['Finddate']=='Tuannay'){
  if ($datenow['mday']-$datenow['wday'] >0)
    {$thang2=$datenow['mon'];$ngay2=$datenow['mday'];
    $thang1=$thang2;$ngay1=$ngay2-$datenow['wday']+1;}
  else
  {
    $thang=$datenow['mon'];$mday= $datenow['mday'];$wday=['wday'];
    if( ($thang==1) || ($thang==3) || ($thang==5) || ($thang==7) || ($thang==8) || ($thang==10) || ($thang==12) )
      $maxmonth=31;
    elseif($thang==2)
      $maxmonth=28;
    else
      $maxmonth=30;
    $thang2=$thang;$ngay2=$mday;
    $thang1=$thang2-1;$ngay1=$maxmonth-$mday;
  }
  }
  if ($datenow['mon']==1) $nam1=$datenow['year']-1; else $nam1=$datenow['year'];
  $nam2=$datenow['year'];
  $date1=$nam1.'-'.$thang1.'-'.$ngay1;
  $date2=$nam2.'-'.$thang2.'-'.$ngay2;
  $where=" DATE(h.NgayLap) BETWEEN '$date1' AND '$date2' ";
  echo $where;

} ?>
