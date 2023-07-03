<?php

namespace AcquaintSofttech\StataMailer\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\Support\Arr;
use AcquaintSofttech\StataMailer\Settings;
use AcquaintSofttech\StataMailer\Events\StataMailConfiguration;

class SettingsController extends CpController
{
    public function edit()
    {
        $blueprint = Settings::blueprint();

        $fields = $blueprint
            ->fields()
            ->addValues(Settings::load()->all())
            ->preProcess();

        return view('stata-mailer::settings.edit', [
            'title' => 'Mail Configuration',
            'action' => cp_route('stata-mailer.update'),
            'blueprint' => $blueprint->toPublishArray(),
            'meta' => $fields->meta(),
            'values' => $fields->values(),
        ]);
    }

    public function update(Request $request)
    {

        $blueprint = Settings::blueprint();

        $fields = $blueprint->fields()->addValues($request->all());

        $fields->validate();

        $values = Arr::removeNullValues($fields->process()->values()->all());

        $this->saveSmtpConfig($values);

        Settings::load($values)->save();

    }

    public function saveSmtpConfig($values)
    {  
        StataMailConfiguration::dispatch($values);
    }
}
