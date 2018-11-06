<?php $desc = isset($desc) ? $desc : null; ?>
<?php $on = isset($on) ? $on : null; ?>
<?php $app_dir = isset($app_dir) ? $app_dir : null; ?>
<?php $branch = isset($branch) ? $branch : null; ?>
<?php $origin = isset($origin) ? $origin : null; ?>
<?php $__container->servers(['aws' => 'ubuntu@52.70.33.114']); ?>

 <?php require_once('vendor/autoload.php'); ?>

<?php

	$origin = 'git@github.com:millanperez/curso-envoy-aws';
	$branch = isset($branch) ? $branch : 'master';
	$app_dir = '/var/www/html/curso-envoy-aws';
	
	if (! isset($on)) {
		throw new exception('La variable --on no está disponible');
	}

?>

<?php $__container->startMacro('app:deploy', ['on' => $on, 'confirm' => true]); ?>

	down
	git:pull
	migrate
	composer:install
	assets:install
	cache:clear
	up

<?php $__container->endMacro(); ?>

<?php $__container->startTask('git:clone', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	echo "hemos entrado al directorio /var/www/html";
	git clone <?php echo $origin; ?>;
	echo "repositorio clonado correctamente";

<?php $__container->endTask(); ?>


<?php $__container->startTask('git:pull', ['desc' => $desc]); ?>

	git commit -am "<?php echo $desc; ?>";
	git push origin master
	echo "código enviado con exito!";

<?php $__container->endTask(); ?>

<?php $__container->startTask('git:pull', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	echo "hemos entrado al directorio <?php echo $app_dir; ?>";
	git pull origin <?php echo $branch; ?>;
	echo "código actualizado correctamente";

<?php $__container->endTask(); ?>

<?php $__container->startTask('ls', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	ls -la

<?php $__container->endTask(); ?>

<?php $__container->startTask('composer:install', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	composer install

<?php $__container->endTask(); ?>

<?php $__container->startTask('assets:install', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	yarn install

<?php $__container->endTask(); ?>

<?php $__container->startTask('key:generate', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	php artisan key:generate

<?php $__container->endTask(); ?>

<?php $__container->startTask('migrate', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	php artisan migrate

<?php $__container->endTask(); ?>

<?php $__container->startTask('up', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	php artisan up

<?php $__container->endTask(); ?>

<?php $__container->startTask('down', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	php artisan down

<?php $__container->endTask(); ?>

<?php $__container->startTask('cache:clear', ['on' => $on]); ?>
	
	cd <?php echo $app_dir; ?>

	php artisan cache:clear
	php artisan view:clear
	php artisan config:clear
	echo "Cache limpiada correctamente!"

<?php $__container->endTask(); ?>