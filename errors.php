<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />

<?php  if (count($errors) > 0) : ?>
  <div class="error" style="color: #F93154;">
  	<?php foreach ($errors as $error) : ?>
  	  <p><i class="fas fa-exclamation-circle"></i> <?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>