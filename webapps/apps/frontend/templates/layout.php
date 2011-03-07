<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas()?>
        <?php include_metas()?>
        <?php include_title()?>
        <link rel="shortcut icon" href="/favicon.ico" />
        
    </head>
    <body>
    	<p class="contact" ><?php echo link_to('投書コーナー' , 'contents/contact')?></p>
        <div id="news">
            <p><?php echo image_tag('caution.jpg' , array('id' => 'caution')) ?>
			<?php echo ' 臨在ニュース！　発信部署をあれこれ追加しました！'?>
        </div>
        <?php echo $sf_content?>
    </body>
</html>
