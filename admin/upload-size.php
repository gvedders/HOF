<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

	echo "$imgfile, $imgfile_name, $imgfile_size, $imgfile_type";
    /* SUBMITTED INFORMATION - use what you need
     * temporary filename (pointer): $imgfile
     * original filename           : $imgfile_name
     * size of uploaded file       : $imgfile_size
     * mime-type of uploaded file  : $imgfile_type
     */

     /*== upload directory where the file will be stored 
          relative to where script is run ==*/
    
    $uploaddir = "../photos";
    

    /*== get file extension (fn at bottom of script) ==*/
    /*== checks to see if image file, if not do not allow upload ==*/
    $pext = getFileExtension($imgfile_name);
    $pext = strtolower($pext);
    if (($pext != "jpg")  && ($pext != "jpeg"))
    {
        print "<h1>ERROR</h1>Image Extension Unknown.<br>";
        print "<p>Please upload only a JPEG image with the extension .jpg or .jpeg ONLY<br><br>";
        print "The file you uploaded had the following extension: $pext</p>\n";

        /*== delete uploaded file ==*/
        unlink($imgfile);
        exit();
    }


    //-- RE-SIZING UPLOADED IMAGE

    /*== only resize if the image is larger than 250 x 200 ==*/
    $imgsize = GetImageSize($imgfile);

    /*== check size  0=width, 1=height ==*/
    if (($imgsize[0] > 169) || ($imgsize[1] > 215)) 
    {
        /*== temp image file -- use "tempnam()" to generate the temp
             file name. This is done so if multiple people access the 
            script at once they won't ruin each other's temp file ==*/
        $tmpimg = tempnam("/tmp", "MKUP");

        /*== RESIZE PROCESS
             1. decompress jpeg image to pnm file (a raw image type) 
             2. scale pnm image
             3. compress pnm file to jpeg image
        ==*/
        
        /*== Step 1: djpeg decompresses jpeg to pnm ==*/
        system("djpeg $imgfile >$tmpimg");
        

        /*== Steps 2&3: scale image using pnmscale and then
             pipe into cjpeg to output jpeg file ==*/
        system("pnmscale -xy 169 215 $tmpimg | cjpeg -smoo 10 -qual 50 >$imgfile");

        /*== remove temp image ==*/
        unlink($tmpimg);

    }

    /*== setup final file location and name ==*/
    /*== change spaces to underscores in filename  ==*/
    $final_filename = str_replace(" ", "_", $imgfile_name);
    $final_filename = "0.jpg";
    $newfile = $uploaddir . "/$final_filename";
    
    /*== do extra security check to prevent malicious abuse==*/
    if (is_uploaded_file($imgfile))
    {

       /*== move file to proper directory ==*/
       if (!copy($imgfile,"$newfile")) 
       {
          /*== if an error occurs the file could not
               be written, read or possibly does not exist ==*/
          print "Error Uploading File.";
          exit();
       }
     }

    /*== delete the temporary uploaded file ==*/
    unlink($imgfile);

    
    print("<img src=\"../photos/$final_filename\">");

    /*== DO WHATEVER ELSE YOU WANT
         SUCH AS INSERT DATA INTO A DATABASE  ==*/

}
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">

    <p>Upload Image: <input type="file" name="imgfile"><br>
    <font size="1">Click browse to upload a local file</font><br>
    <br>
    <input type="submit" value="Upload Image">
    </form>

<?php
    /*== FUNCTIONS ==*/

    function getFileExtension($str) {

        $i = strrpos($str,".");
        if (!$i) { return ""; }

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);

        return $ext;

    }
?>
