<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet"/>
        <style type="text/css">
            body {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-font-smoothing: antialiased;
                font-family: 'Lato', sans-serif;
            }
            a {
                color: #4020aa;
                text-decoration: none;
            }
            a:hover {
                color: #7252de;
                text-decoration: none;
            }
        </style>
    </head>
    <body style="margin: 0;">
        <table bgcolor="#fff" style="width: 100%; background: #fff; padding: 30px;">
            <tr>
                <td>
                    <table width="600px" style="margin: auto;">
                        <tr>
                            <td style="text-align: center;">
                                <a href="" style="display: inline-block; margin-bottom: 25px;"><img src="{{ asset('public/assets/global/images/logo.jpg')}}"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table bgcolor="#f8f8f8" style="background: #f8f8f8; border: 1px solid #e3e3e3; padding: 30px; margin: 0 0 33px;">
                                    <tr>
                                        <td>
                                            <h2 style="font-size: 20px; font-weight: normal; margin: 0 0 10px;">{{ $data->name }} <span style="font-weight: bold;">{{ $data->email }}</span></h2>
                                            <p style="margin: 0 0 25px;">signup_msg1 <a href="#" style="color: #d18648; text-decoration: none;">warm_up</a>,signup_msg2</p>
                                            <!-- <a href="https://beta.smartmoney.de/public/home" style="display: inline-block; margin: 0 0 25px;">https://beta.smartmoney.de/public/home</a> -->

                                            <a href="{{ url('/') }}" style="display: inline-block; margin: 0 0 25px;">{{ url('/') }}</a>

                                            <p style="margin: 0;">signup_msg3</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <span style="display: inline-block; font-size: 13px; color: #666666; margin: 0 0 30px">&copy; copyright</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
