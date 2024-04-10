@php
$set  =   App\Http\Controllers\SettingController::getSetting();
echo $set['mail_body_owner'];
@endphp