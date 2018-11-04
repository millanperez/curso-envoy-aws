@servers(['aws' => 'ubuntu@52.70.33.114'])

@include('vendor/autoload.php')

@setup



@endsetup

@task('')
	

@endtask

@task('ls', ['on' => 'aws'])
	
	cd /var/www/html
	ls -la

@endtask