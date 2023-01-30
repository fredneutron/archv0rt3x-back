@extends('email.layout')

@section('content')
    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
        <tbody>
            {{-- {{$name}} --}}
            <tr>
                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 50px; padding-right: 50px; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #506bec; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:38px;"><strong><span style="">Hey! , new contact notification</span></strong></span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px;"><span style="font-size:16px;">{{ $name }}({{ $email }}), left a message in your contact page box about "{{$subject}}", here is the message.</span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px;">{{ $message }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tr>
                            <td style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:20px;text-align:left;">
                                <a href="{{ $reply }}" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#506bec;border-radius:16px;width:auto;border-top:0px solid TRANSPARENT;border-right:0px solid TRANSPARENT;border-bottom:0px solid TRANSPARENT;border-left:0px solid TRANSPARENT;padding-top:8px;padding-bottom:8px;font-family:Helvetica Neue, Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank">
                                    <span style="padding-left:25px;padding-right:20px;font-size:15px;display:inline-block;letter-spacing:normal;">
                                        <span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">
                                            <span data-mce-style="font-size: 15px; line-height: 30px;" style="font-size: 15px; line-height: 30px;"><strong>REPLY</strong></span>
                                        </span>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px;"><span style="font-size:14px;">Having trouble? log on to your email client to reply.</span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    {{-- <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px;">Cras euismod erat quis eros imperdiet malesuada.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table> --}}
                </td>
            </tr>
        </tbody>
    </table>
@endsection