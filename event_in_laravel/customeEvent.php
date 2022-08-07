<!-- step 1 . -->

<!-- open EventServiceProvider file and write like down code . -->
<?php

protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
        ],
    'App\Events\Mailevent'=>[
        'App\Listeners\Maillistener',
        ],
];

//  step 2 

php artisan event:generate