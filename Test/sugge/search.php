<?php
include('../../Connection/connect.php');
if($_POST)
{
$q=mysqli_real_escape_string($con,($_POST['searchword']));
//Old query
//$sql_rees=
//mysql_query("select * from test_user_data where fname like '%$q%' or lname like '%$q%' order by uid LIMIT 5");
//New query updated 04-02-2014
$sql_res=mysqli_query($con,"select * from users where (firstname like '%$q%' or lastname like '%$q%') OR (CONCAT(firstname,' ',lastname) like '%$q%') order by id LIMIT 5");
while($row=mysqli_fetch_array($sql_res,MYSQLI_ASSOC))
{
$u = $row['username'];	
$fname=$row['firstname'];
$lname=$row['lastname'];
$img=$row['dplink'];
//$country=$row['country'];
$re_fname='<b>'.$q.'</b>';
$re_lname='<b>'.$q.'</b>';
$final_fname = str_ireplace($q, $re_fname, $fname);
$final_lname = str_ireplace($q, $re_lname, $lname);
$pic = '<img src="../../Users/'.$u.'/'.$img.'" style="width:50px;height:50px;">';
?>
<div class="display_box" align="left"><a href="../../users.php?u=<?php echo $u;?>">
<?php echo $pic; ?>
<div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">
<?php echo $final_fname; ?>&nbsp;
<?php echo $final_lname; ?><div>@<?php echo $u;?></a></div></div><br/>
<?php //echo $country; ?>
</div>
<?php
}
}
else
{}
?>
