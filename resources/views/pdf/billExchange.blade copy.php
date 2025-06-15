<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سند قبض</title>
    <link href="https://fonts.googleapis.com/css2?family=Circo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Circo', sans-serif;
            /* Apply Circo font */
            direction: rtl;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .receipt-container {
            max-width: 850px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px 30px;
        }

        .header {
            display: flex;
            justify-content: center;
            /* Center the content horizontally */
            align-items: center;
            border-bottom: 3px solid #f0ad4e;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header .logo img {
            margin-top: 12px;
            max-height: 90px;
            width: auto;
        }

        .header .company-info {
            text-align: left;
            color: #333;
        }

        .header .company-info h1 {
            font-size: 24px;
            margin: 0;
            color: #f0ad4e;
        }

        .header .company-info p {
            font-size: 16px;
            margin: 5px 0 0;
            color: #666;
        }

        .receipt-title {
            text-align: center;
            margin: 20px 0;
        }

        .receipt-title h2 {
            font-size: 28px;
            margin: 0;
            color: #333;
            font-weight: bold;
        }

        .details {
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .details .field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
        }

        .details .field span {
            font-size: 16px;
            color: #333;
        }

        .details .field span:last-child {
            font-weight: bold;
            color: #444;
        }

        /* .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signatures .signature {
            text-align: center;
            font-size: 16px;
            flex: 1;
        }

        .signatures .signature:not(:last-child) {
            margin-right: 20px;
        }

        .signatures .line {
            width: 100%;
            height: 2px;
            background: #333;
            margin: 10px auto 0;
        } */

        .signatures {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 40px;
            gap: 30px;
            /* مسافة بين العناصر */
        }

        .signatures .signature {
            text-align: center;
            font-size: 16px;
            width: 45%;
            /* لتحديد عرض مناسب لكل قسم */
            position: relative;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 30px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 600px) {
            .receipt-container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header .company-info h1 {
                font-size: 20px;
            }

            .receipt-title h2 {
                font-size: 22px;
            }

            .signatures {
                flex-direction: column;
                margin-top: 20px;
            }

            .signatures .signature {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            <div class="logo">
                <img alt="Logo" src="https://taqat-gaza.com/uploads/images/settings//I99I9XyqKRi8w5sW.png"
                    class="h-120px" style="width: 180px; height: auto;" />
            </div>
        </div>

        <div class="receipt-title">
            <h2>سند استلام رقم({{ $billExchange->receipt_number }})</h2>
        </div>

        <div class="details">
            <div class="field">
                <span>التاريخ:</span>
                <span>{{ $billExchange->date }}</span>
            </div>
            <div class="field">
                <span>السيد / السادة:</span>
                <span>{{ $billExchange->name }}</span>
            </div>
            <div class="field">
                <span>مبلغ وقدره:</span>
                <span>{{ $billExchange->amount }} شيكل</span>
            </div>
            <div class="field">
                <span>مبلغ بالحروف:</span>
                <span>{{ $billExchange->amount_letter }}</span>
            </div>

            <div class="field">
                <span> نقداً:</span>
                <span>{{ $billExchange->cheque_number }}</span>
            </div>
            <div class="field">
                <span> شيك رقم:</span>
                <span>{{ $billExchange->cheque_number }}</span>
            </div>
            <div class="field">
                <span>اسم البنك :</span>
                <span>{{ $billExchange->bank_name }}</span>
            </div>

            <div class="field">
                <span>ملاحظة :</span>
                <span>{{ $billExchange->other_method }}</span>
            </div>
        </div>
        <div class="signatures">
            <div class="signature">
                <span>توقيع الموظف</span>
                <div class="line"></div> <!-- خط التوقيع -->
            </div>
            <div class="signature">
                <span>الختم</span>
                <div class="line"></div> <!-- خط مكان الختم -->
            </div>
        </div>
        {{-- <div class="footer">
            <p>جميع الحقوق محفوظة | مؤسسة طاقات غزة</p>
        </div> --}}
    </div>
</body>

</html>
