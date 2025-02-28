@servers(['develop' => ['root@103.75.180.58']])

@setup
    $now = new DateTime();
    $branch = isset($branch) ? $branch : 'develop';
    $env = isset($env) ? $env : 'develop';

    $webroot_path = '/var/www/';

    $webroot_folder = $branch;

    $app_dir = $webroot_path . 'smart-ads/anti-fraud/' . $webroot_folder;

    $release = $branch . '-' . date('YmdHis');

    $laradock_app_dir = '/var/www/'.$webroot_folder;

    $laradock_dir = $webroot_path . 'laradock';
@endsetup

@story('deploy', ['on' => $env])
    prepare_environment
    update_code
    run_composer
    run_deploy_scripts
    update_permission
    restart_worker
@endstory

@task('prepare_environment')
    source ~/.bashrc
    source ~/.nvm/nvm.sh
    nvm use node
    update-alternatives --set php /usr/bin/php8.2
@endtask

@task('update_code')
    echo 'Updating code'
    cd {{ $app_dir }}
    git reset --hard
    git checkout {{ $branch }}
    git pull origin {{ $branch }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $app_dir }}
    echo "Running composer..."
    composer install --prefer-dist --no-scripts --no-interaction -q -o --dev

    echo "Running npm..."
    source ~/.nvm/nvm.sh
    nvm use node
    yarn install
    yarn build
@endtask

@task('run_deploy_scripts')
    cd {{ $app_dir }}
    echo 'Running deployment scripts'
    php8.2 artisan cache:clear
    php8.2 artisan config:clear
    php8.2 artisan view:clear
    php8.2 artisan storage:link
    php8.2 -d memory_limit=-1 artisan migrate --seed
    php8.2 artisan optimize
@endtask

@task('update_permission')
    echo 'Update the permission'
    cd {{ $app_dir }}
    sudo chown -R www-data:www-data {{ $app_dir }}
@endtask

@task('restart_worker')
    echo "Restarting Worker"
    cd {{ $app_dir }}
    php8.2 artisan queue:restart
@endtask
