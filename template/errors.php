<?php 

    // die('errors');
if(count($errors)):  ?>
<?php foreach( $errors as $error): ?>

<div class="alert alert-danger">

    <p> <?php echo $error  ?></p>
</div>
<?php endforeach ?>



<?php endif;

?>