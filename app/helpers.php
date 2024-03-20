<?php 
use App\Models\Amenity;
use App\Models\Facility;

 function getFacilities($id)
 {
	 $data=array();
	$array=explode(",",$id);
	foreach($array as $ar)
	{
		$query=Facility::find($ar);
		$data[]=$query->facility;
	}
	
	return implode(", ",$data);
 }
 function getAmenities($id)
 {
	 $data=array();
	$array=explode(",",$id);
	foreach($array as $ar)
	{
		$query=Amenity::find($ar);
		$data[]=$query->amenity;
	}
	
	return implode(", ",$data);
 }


?>