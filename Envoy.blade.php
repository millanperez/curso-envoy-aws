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

@macro('app:deploy', ['on' => $on, 'confirm' => true])

	down
	git:pull
	migrate
	composer:install
	assets:install
	cache:clear
	up

@endmacro

@task('git:clone', ['on' => $on])
	
	cd {{ $app_dir }}
	echo "hemos entrado al directorio /var/www/html";
	git clone {{ $origin }};
	echo "repositorio clonado correctamente";

@endtask


@task('git:pull', ['on' => $on])
	
	cd {{ $app_dir }}
	echo "hemos entrado al directorio {{ $app_dir }}";
	git pull origin {{ $branch }};
	echo "código actualizado correctamente";

@endtask

@task('ls', ['on' => $on])
	
	cd {{ $app_dir }}
	ls -la

@endtask

@task('composer:install', ['on' => $on])
	
	cd {{ $app_dir }}
	composer install

@endtask

@task('assets:install', ['on' => $on])
	
	cd {{ $app_dir }}
	yarn install
	npm install
	npm run dev

@endtask

@task('key:generate', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan key:generate

@endtask

@task('migrate', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan migrate

@endtask

@task('up', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan up

@endtask

@task('down', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan down

@endtask

@task('cache:clear', ['on' => $on])
	
	cd {{ $app_dir }}
	php artisan cache:clear
	php artisan view:clear
	php artisan config:clear
	echo "Cache limpiada correctamente!"

@endtask