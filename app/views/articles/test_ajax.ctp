<?php
 echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
?>
<?php echo $form->create('Article', array('url' => 'add')); ?>
<?php echo $ajax->autoComplete('Article.title', 'autoComplete')?>
<?php echo $form->end('View Post')?>

