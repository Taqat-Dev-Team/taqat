<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كشف الحساب</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            direction: rtl;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-top: 30px;
            color: #333;
            font-weight: bold;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .summary {
            margin-top: 40px;
            font-size: 16px;
            color: #333;
            padding: 10px 20px;
            background-color: #e9f7ee;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary p {
            margin: 8px 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background-color: #333;
            color: white;
            text-align: center;
            font-size: 14px;
            border-top: 2px solid #4CAF50;
        }

        .footer p {
            margin: 0;
        }

        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }

    </style>
</head>
<body>

    <h2>كشف الحساب - {{ $account->name }}</h2>
    <p>تاريخ: {{ now()->format('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>التاريخ</th>
                <th>من حساب</th>
                <th>الى حساب</th>

                <th>العملية</th>
                <th>الرصيد الحالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactionDetails as $transaction)
                <tr>
                    <td>{{ $transaction['date'] }}</td>
                    <td>{{ $transaction['form_account'] }}</td>
                    <td>{{ $transaction['to_account'] }}</td>
                    <td>
                        @if ($transaction['debit'] > 0)
                            <span style="color: red;">مدين: {{ number_format($transaction['debit'], 2) }}</span>
                        @endif
                        @if ($transaction['credit'] > 0)
                            <span style="color: green;">دائن: {{ number_format($transaction['credit'], 2) }}</span>
                        @endif
                    </td>
                    <td>{{ number_format($transaction['current_balance'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>إجمالي المدين: </strong><span class="highlight">{{ number_format($totalDebit, 2) }}</span></p>
        <p><strong>إجمالي الدائن: </strong><span class="highlight">{{ number_format($totalCredit, 2) }}</span></p>
        <p><strong>الرصيد الصافي: </strong><span class="highlight">{{ number_format($netBalance, 2) }}</span></p>
    </div>

    <div class="footer">
        <p>تم إنشاؤه بواسطة نظام إدارة الحسابات | جميع الحقوق محفوظة</p>
    </div>

</body>
</html>
