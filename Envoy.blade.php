@servers(['aws' => 'ubuntu@52.70.33.114'])

@include('vendor/autoload.php')

@setup

	$origin = 'git@github.com:millanperez/curso-envoy-aws';
	$branch = isset($branch) ? $branch : 'master';
	$app_dir = '/var/www/html/curso-envoy-aws';
	
	if (! isset($on)) {
		throw new exception('La variable --on no está disponible');
	}

@endsetup

@task('git:clone', ['on' => $on])
	
	cd {{ $app_dir }}
	echo "hemos entrado al directorio /var/www/html";
	git clone {{ $origin }};
	echo "repositorio clonado correctamente";

@endtask

@task('ls', ['on' => $on])
	
	cd {{ $app_dir }}
	ls -la

@endtask

@task('composer:install', ['on' => $on])
	
	cd {{ $app_dir }}
	composer install

@endtask

@task('key:generate', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan key:generate

@endtask