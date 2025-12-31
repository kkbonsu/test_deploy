<?php
namespace Deployer;

require 'recipe/common.php';
require 'recipe/laravel.php';

set('application', 'Test Deploy');
set('php_fpm_version', '8.2');
set('repository', 'git@github.com:kkbonsu/test_deploy.git');

host('16.60.128.51')
    ->set('remote_user', 'ubuntu')
    ->set('deploy_path', '/home/ubuntu/test_deploy')
    ->set('identity_file', '/Users/kwamebonsu/.ssh/AYUDA.pem')
    ->set('multiplexing', false)
    ->set('git_tty', false)
    ->set('labels', ['stage' => 'live'])
    ->set('writable_mode', 'chmod');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:migrate',
    'deploy:symlink',
    'php-fpm:reload',
]);

task('php-fpm:reload', function () {
    run('sudo service php8.2-fpm reload');
});

after('deploy:failed', 'deploy:unlock');
