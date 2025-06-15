<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تقديم عرض على مشروع {{$project->project->title}}</title>

    <!-- Font Import -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <!-- Inline Styles for Email Clients -->
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family: 'Open Sans', Arial, sans-serif;
            color: #797e82;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        img {
            border: 0;
            display: block;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        .button {
            display: inline-block;
            padding: 15px 25px;
            background-color: #197dbb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 100px;
            font-weight: 700;
            text-align: center;
            font-size: 13px;
            line-height: 120%;
        }

        .button:hover {
            background-color: #165a8b;
        }

        @media only screen and (max-width: 480px) {
            .full-width-mobile {
                width: 100% !important;
            }

            .full-width-mobile td {
                width: auto !important;
            }

            .button {
                padding: 10px 20px;
                font-size: 12px;
            }
        }

        /* RTL Styles for Arabic */
        [dir="rtl"] .whatsapp-icon {
            left: auto;
            right: 20px;
        }

        [dir="rtl"] body {
            direction: rtl;
            font-family: 'Tajawal', sans-serif;
        }

        [dir="rtl"] .button {
            text-align: right;
        }
    </style>
</head>

<body dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff;">
        <tr>
            <td style="padding: 20px 0; text-align: center;">
                <img src="https://team.taqat-gaza.com/assets/logo.png" style="margin: 0 35%" alt="Taqat Gaza" width="30%">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center;">
                <h4 style="color: #000000; line-height: 32px;"> {{$project->project->title}}</h4>
                <p>{{$project->description }}</p>
                <a  style="color: white;" href="https://taqat-gaza.com/ar/project/{{$project->project->slug}}" class="button">عرض تفاصيل العرض</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center;">
                <p style="margin: 10px 0;">Thanks & Regards,</p>
                <p style="margin: 10px 0;">Taqat Gaza Team</p>
                <p>If you have any questions or need further assistance, feel free to contact us at <a href="mailto:support@taqat-gaza.com" style="color:#197dbb;">support@taqat-gaza.com</a></p>
                <a href="https://taqat-gaza.com" style="color:#197dbb;">Visit our website</a>
            </td>
        </tr>
    </table>
</body>

</html>
