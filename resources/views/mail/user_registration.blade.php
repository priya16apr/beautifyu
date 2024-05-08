@php

$data  =   App\Http\Controllers\MailTemplateController::getContent('1');

echo $data['body'];

@endphp