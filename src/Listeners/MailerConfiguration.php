<?php

namespace AcquaintSofttech\StataMailer\Listeners;

use Stillat\Proteus\Support\Facades\ConfigWriter;
use Illuminate\Support\Facades\Artisan;

class MailerConfiguration
{
    public function handle($event)
    {
        $data = $event->data;

        switch($data['mailer']) {
            case('smtp'):
                $this->smtpConfigSave($data);
                break;
        }

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('statamic:stache:clear');
    }

    public function smtpConfigSave($data)
    {
        // Smtp Configuration set into mail.php 
        ConfigWriter::edit('mail')->replace('default',$data['mailer'])->save();

        ConfigWriter::write('mail.mailers.smtp.transport',$data['mailer']);

        // ConfigWriter::write('mail.mailers.smtp.host',$data['smtp_host']);
        ConfigWriter::edit('mail')->merge('mailers.smtp', [
            'host' => $data['smtp_host']
        ])->save();

        ConfigWriter::write('mail.mailers.smtp.port',$data['smtp_port']);
        ConfigWriter::write('mail.mailers.smtp.encryption',$data['encryption']);
        
        ConfigWriter::write('mail.mailers.smtp.username',$data['smtp_username']);
        ConfigWriter::write('mail.mailers.smtp.password',$data['smtp_password']);

        // From email and name replace
        ConfigWriter::edit('mail')->replace('from',
            [
                'address' => $data['from_email'],
                'name' => $data['from_name']
            ]
        )->save();
    }
}
