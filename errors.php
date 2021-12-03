<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />

<?php if (count($errors) > 0) : ?>
	<div class="alert alert-danger" role="alert" style="margin: 1%">
		<?php foreach ($errors as $error) : ?>
			<p><i class="fas fa-exclamation-circle"></i> <?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>