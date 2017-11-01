<?php
include_once ("faceDetect.php");

/*include "faceDetect.php";

$detector = new svay\faceDetect('detection.dat');
$detector->faceDetect('lena512color.jpg');
$detector->toJpeg();*/
$detector = new FaceDetector('detection.dat');
$detector->faceDetect('test2.jpg');
$detector->toJpeg();?>