<?php
class Reply extends CWidget {
 
    public $reply = InfoComment;
    public function run() {
        $this->render('reply');
    }
 
}
?>