<?php
spl_autoload_register(function ($class){
    include_once("../classes/" . $class . ".class.php");


});
session_start();

$no = $_POST['getresult'];
$post = new Post();
$items = $post->loadMore($no);




foreach($items as $test): ?>

    <div class="col-sm-2 test">
        <a href="detail.php?id=<?php echo $test['id']?>">
            <div class="center">
                <input type="checkbox" class="checkbox" id="<?php echo $topic["id"];?>" value="<?php echo $topic["description"];?>">
                <label class="topicimg" style="background-image:url(<?php echo $test['image'];?>)" for="<?php echo $topic["id"];?>">
                    <span class="overlay"><?php echo htmlspecialchars($test['title'])?> <?php htmlspecialchars($test['beschrijving']);?></span>
                </label>
            </div>
    </div>
<?php endforeach;?>