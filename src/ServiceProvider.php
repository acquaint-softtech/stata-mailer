<?php

namespace AcquaintSofttech\StataMailer;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Facades\CP\Nav;
use Illuminate\Support\Facades\Event;
use AcquaintSofttech\StataMailer\Events\StataMailConfiguration;
use AcquaintSofttech\StataMailer\Listeners\MailerConfiguration;

class ServiceProvider extends AddonServiceProvider
{
    // Register CP Routes
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function bootAddon()
    {
        // Add Nav To Tools
        Nav::extend(function ($nav) {
                $nav->tools('Settings')
                    ->route('stata-mailer.edit')
                    ->icon('<svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19 0.9H1C0.944772 0.9 0.9 0.944771 0.9 1V13C0.9 13.0552 0.944772 13.1 1 13.1H19C19.0552 13.1 19.1 13.0552 19.1 13V1C19.1 0.944772 19.0552 0.9 19 0.9ZM1 0C0.447715 0 0 0.447716 0 1V13C0 13.5523 0.447716 14 1 14H19C19.5523 14 20 13.5523 20 13V1C20 0.447715 19.5523 0 19 0H1Z" fill="black"/><path fill-rule="evenodd" clip-rule="evenodd" d="M2.61413 3.76848C2.742 3.55537 3.01842 3.48626 3.23153 3.61413L10.4918 7.9703L17.2567 3.62147C17.4657 3.48708 17.7441 3.5476 17.8785 3.75666C18.0129 3.96572 17.9524 4.24414 17.7433 4.37853L10.7433 8.87853C10.5993 8.97111 10.4153 8.97395 10.2685 8.88587L2.76848 4.38587C2.55537 4.25801 2.48627 3.98159 2.61413 3.76848ZM6.89071 8.27674C7.01402 8.49252 6.93905 8.76741 6.72327 8.89071L3.22327 10.8907C3.00748 11.014 2.7326 10.939 2.60929 10.7233C2.48599 10.5075 2.56096 10.2326 2.77674 10.1093L6.27674 8.10929C6.49252 7.98599 6.76741 8.06096 6.89071 8.27674ZM14.1256 8.25039C14.2634 8.0436 14.5428 7.98772 14.7496 8.12558L17.7496 10.1256C17.9564 10.2634 18.0123 10.5428 17.8744 10.7496C17.7366 10.9564 17.4572 11.0123 17.2504 10.8744L14.2504 8.87442C14.0436 8.73657 13.9877 8.45718 14.1256 8.25039Z" fill="black"/></svg>')
                    ->active('settings');
        });

        // Register Event And Listeners
        $this->registerEventListeners();
    }

    public function registerEventListeners()
    {
        Event::listen(StataMailConfiguration::class, MailerConfiguration::class);
    }
}
