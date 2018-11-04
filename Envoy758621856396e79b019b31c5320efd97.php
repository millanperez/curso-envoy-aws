<?php $on = isset($on) ? $on : null; ?>
<?php $app_dir = isset($app_dir) ? $app_dir : null; ?>
<?php $branch = isset($branch) ? $branch : null; ?>
<?php $origin = isset($origin) ? $origin : null; ?>
<?php $__container->servers(['aws' => 'ubuntu@52.70.33.114']); ?>

 <?php require_once('vendor/autoload.php'); ?>

<?php

	$origin = 'git@github.com:millanperez/curso-envoy-aws';
	$branch = isset($branch) ? $branch : 'master';
	$app_dir = '/var/www/html';
	if (! isset($on)) {
		throw new exception('La variable --on no está disponible');
	}

?>

<?php $__container->startTask(''); ?>
	

<?php $__container->endTask(); ?>

<?php $__container->startTask('ls', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	ls -la

<?php $__container->endTask(); ?>