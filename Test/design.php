<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style type="text/css">
        div.fileinputs {
            position: relative;
        }

        div.fakefile {
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 1;
        }

        div.fakefile input[type=button] {
            /* enough width to completely overlap the real hidden file control */
            cursor: pointer;
            width: 148px;
        }

        div.fileinputs input.file {
            position: relative;
            text-align: right;
            -moz-opacity:0 ;
            filter:alpha(opacity: 0);
            opacity: 0;
            z-index: 2;
        }
    </style>
<body>
    <div class="fileinputs">
        <input type="file" class="file" />

        <div class="fakefile">
            <input type="button" value="Select file" />
        </div>
    </div>
    </body>
    </html>