@component('mail::message')
<p> Hi,</p>
<p>A customer is interested in one of your vehicles.</p>
<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Dealer</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->dealer->name}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Vehicle</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->car}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Button Clicked</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->type == 0 ? 'Lease' : 'Buy'}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Price</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->price}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Name</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->first_name.' '.$inquiry->last_name}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Email</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->email}}</td>
    </tr>
    <tr>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Phone</td>
        <td valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">{{$inquiry->phone}}</td>
    </tr>
    <tr>
        <td colspan="2" valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px; font-weight:bold;">Message</td>
    </tr>
    <tr>
        <td colspan="2" valign="middle" height="44" style="font-family: Arial, sans-serif; font-size:14px;">{{$inquiry->message}}</td>
    </tr>
</table>
<p>{{ config('app.name') }}</p>
@endcomponent