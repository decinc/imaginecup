<?php
/**
 * BarcodeQR - Code QR Barcode Image Generator (PNG)
 *
 * @package BarcodeQR
 * @category BarcodeQR
 * @name BarcodeQR
 * @version 1.0
 * @author Shay Anderson 05.11
 * @link http://www.shayanderson.com/php/php-qr-code-generator-class.htm
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * This is free software and is distributed WITHOUT ANY WARRANTY
 */
final class BarcodeQR {

	const API_CHART_URL = "http://chart.apis.google.com/chart";

	public function draw($size = 150, $filename = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_CHART_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$img = curl_exec($ch);
		curl_close($ch);

		if($img) {
			if($filename) {
				if(!preg_match("#\.png$#i", $filename)) {
					$filename .= ".png";
				}
				
				return file_put_contents($filename, $img);
			} else {
				header("Content-type: image/png");
				print $img;
				return true;
			}
		}

		return false;
	}


	public function text($text = null) {
		$this->_data = $text;
	}
}
?>