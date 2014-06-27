<div id="reply">   
    <?php 
    	$reply->user = '';
        if(isset($reply['url'])) {
            echo CHtml::link($reply['name'], $reply['url']);
        } else {
            echo $reply['name'];
        }
    ?>
</div>