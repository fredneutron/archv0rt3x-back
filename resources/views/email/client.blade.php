@extends('email.layout')

@section('content')
    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
        <tbody>
            <tr>
                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 50px; padding-right: 50px; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #506bec; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:38px;"><strong><span style="">Hi {{ $name }} ,</span></strong></span></p>
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
                                        <p style="margin: 0; font-size: 14px;"><span style="font-size:16px;">Thank you for contacting for {{ env('APP_NAME') }},</span></p>
                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"> </p>
                                        <p style="margin: 0; font-size: 14px;"><span style="font-size:16px;">your message({{$subject}}) has been delivered to the admin, you will get a response as soon as possible.</span></p>
                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"> </p>
                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"> </p>
                                        <p style="margin: 0; font-size: 14px;"><span style="font-size:16px;">Best Regards,</span></p>
                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"> </p>
                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"> </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                        <tr>
                            <td>
                                <div style="font-family: sans-serif">
                                    <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; font-size: 12px; mso-line-height-alt: 14.399999999999999px;"> </p>
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