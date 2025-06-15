<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سند قبض VIP</title>
    <style>
        body {
            font-family: 'dejavusans', sans-serif;
            direction: rtl;
            text-align: right;
            background: #f8f5f0;
            margin: 0;
            padding: 0;
        }

        .royal-voucher {
            background: #fffdfa;
            width: 750px;
            padding: 20px;
            margin: 0 auto;
            border: 3px solid #c5a467;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .royal-header {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .royal-header h1 {
            color: #3a2c1a;
            font-size: 28px;
            margin: 0;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .company-details {
            font-size: 14px;
            color: #665947;
            margin-top: 5px;
        }

        .detail-box {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .detail-box span {
            font-size: 16px;
            color: #3a2c1a;
        }

        .amount-display {
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            border: 2px dashed #c5a467;
            font-size: 18px;
            font-weight: bold;
        }

        .signature-area {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .seal-of-approval {
            width: 100px;
            height: 100px;
            border: 3px solid #c5a467;
            border-radius: 50%;
            text-align: center;
            line-height: 95px;
            font-size: 14px;
            color: #665947;
        }

        .signature-text {
            text-align: right;
        }

        .signature-text span {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .date {
            font-size: 16px;
            color: #3a2c1a;
        }
    </style>
</head>
<body>
    <div class="royal-voucher">
        <div class="royal-header">
            <img src="https://taqat-gaza.com/uploads/images/settings//I99I9XyqKRi8w5sW.png" alt="Logo" class="logo">
            <div>
                <h1>سند قبض</h1>
            </div>
        </div>



        {{-- <div class="detail-box">
            <span>رقم السند:</span>
            <span>#{{$sanedNumber}}</span>
        </div> --}}

        <div class="detail-box">
            <span>اسم :</span>
            <span>{{$name}}</span>
        </div>

        <div class="detail-box">
            <span>اسم المستلم:</span>
            <span>{{$recipientName}}</span>
        </div>
        <div class="detail-box">
            <span>  المبلغ : </span>
            <span>{{$amount}}</span>
        </div>

        <div class="detail-box">
            <span>  المبلغ بالحروف : </span>
            <span>{{$amount_letter}}</span>
        </div>
        <div class="detail-box">
            <span>الغرض من السداد:</span>
            <span>{{$purpose}}</span>
        </div>



        </div>
    </div>
</body>
</html>
