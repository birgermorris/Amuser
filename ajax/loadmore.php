<?php
spl_autoload_register(function ($class){
    include_once("../classes/" . $class . ".class.php");


});
session_start();

$no = $_POST['getresult'];
$post = new Post();
$items = $post->loadMore($no);




foreach($collection as $c): ?>

    <div class="col-sm-2 test">
            <div class="center">

            </div>
    </div>
<?php endforeach;?>