<?php include('inc/head.php'); ?>

    <?php

function ScanDirectory($directory){

    $myDirectory = opendir($directory) or die('Erreur');

    while($Entry = readdir($myDirectory)) {

        if(is_dir($directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
            if(!in_array($directory,array(".",".."))){
            echo '<ul>'.basename($directory);
                ScanDirectory($directory.'/'.$Entry);
                echo '</ul>';
            }

        }
        else {
            if(!in_array($Entry,array(".",".."))) {
                echo '<li><a href="?f='.$directory.'/'. $Entry . '">'. $Entry . '</a></li>';
            }
        }
    }

    closedir($myDirectory);
}

ScanDirectory('./files');




?>
<?php

if(isset($_POST["content"])){
    $fichier = $_GET['f'] ;

    $file = fopen($fichier,"w");
    fwrite($file,$_POST["content"]);
    fclose($file);
}
?>
<?php if(strrchr($_GET['f'],'.') == '.jpg'){?>

     <img src="<?php echo $_GET['f'];?>" style="width: 80%; height: auto;"></img>



    <?php



}


    else{

echo '
    <form action="" method="POST">
        <div>
            <div>
                <span>Edition</span>
            </div>
            <textarea class="tinymce" style="width:100%; height:300px;" name="content">'.file_get_contents($_GET['f']).'</textarea>
        </div>
        <input type="submit" name="modify" value="Modifier">
    </form>';
  }?>
<?php if(isset($_POST["delete"])){
    $document = $_GET['f'] ;
    unlink($document);

}?>
<form action="" method="post">
    <input type="submit" name="delete" class="delete" value="Suprimer">
</form>
<?php include('inc/foot.php'); ?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>