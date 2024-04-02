<?php

use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Rent;
use App\Models\Tenant;

function getFacilities($id)
{
	$data = array();
	$array = explode(",", $id);
	foreach ($array as $ar) {
		$query = Facility::find($ar);
		$data[] = $query->facility;
	}

	return implode(", ", $data);
}
function getAmenities($id)
{
	$data = array();
	$array = explode(",", $id);
	foreach ($array as $ar) {
		$query = Amenity::find($ar);
		$data[] = $query->amenity;
	}

	return implode(", ", $data);
}

function withoutGst($total, $gst, $tds)
{
	$basicrent = $total - $gst + $tds;
	return $basicrent;
}

function getIndianCurrency(float $number)
{
	$decimal = round($number - ($no = floor($number)), 2) * 100;
	$hundred = null;
	$digits_length = strlen($no);
	$i = 0;
	$str = array();
	$words = array(
		0 => '', 1 => 'one', 2 => 'two',
		3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
		7 => 'seven', 8 => 'eight', 9 => 'nine',
		10 => 'ten', 11 => 'eleven', 12 => 'twelve',
		13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
		16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
		19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
		40 => 'forty', 50 => 'fifty', 60 => 'sixty',
		70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
	);
	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	while ($i < $digits_length) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += $divider == 10 ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
		} else $str[] = null;
	}
	$Rupees = implode('', array_reverse($str));
	$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	return strtoupper($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

function getDates($duration, $agreement)
{
	$months = str_replace("Month(s)", "", $duration);
	$marray = explode(",", $months);
	$first = trim($marray[0]);
	$last = trim(end($marray));

	$queryone = Rent::where('agreement_id', $agreement)->where('rent_no', $first)->first();
	$querytwo = Rent::where('agreement_id', $agreement)->where('rent_no', $last)->first();

	return "For Period " . date("d-m-Y", strtotime($queryone->due_date)) . " To " . date("d-m-Y", strtotime($querytwo->due_date));
}

function getTenantdata($id, $field)
{
	$query = Tenant::find($id);
	return $query->{$field};
}
