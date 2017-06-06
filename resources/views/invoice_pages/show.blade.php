<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ekaruz invoice</title>
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css" media="all" />
    <style>
        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:30px;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }

        .invoice-box table{
            width:100%;
            line-height:inherit;
            text-align:left;
        }

        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table tr td:nth-child(2){
            text-align:left;
        }

        .invoice-box table tr.top table td{
            padding-bottom:20px;
        }

        .invoice-box table tr.top table td.title{
            font-size:45px;
            line-height:45px;
            color:#333;
        }

        .invoice-box table tr.information table td{
            padding-bottom:40px;
        }

        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .invoice-box table tr.details td{
            padding-bottom:20px;
        }

        .invoice-box table tr.item td{
            border-bottom:1px solid #eee;
        }

        .invoice-box table tr.item.last td{
            border-bottom:none;
        }

        .invoice-box table tr.total td:nth-child(2){
            border-top:2px solid #eee;
            font-weight:bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td{
                width:100%;
                display:block;
                text-align:center;
            }

            .invoice-box table tr.information table td{
                width:100%;
                display:block;
                text-align:center;
            }
        }
        .invoice-right{
            text-align:right !important;
        }
    </style>

</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <img src="/images/logo.png" style="width:100%; max-width:100px;">
                        </td>

                        <td class="invoice-right">
                            Ekaruz Technology<br>
                            {{$invoice->ekaruz->street_address.', '.$invoice->ekaruz->town_address}}<br>
                            {{$invoice->ekaruz->state_address}}, Nigeria
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <strong>INVOICE TO:</strong><br>
                            {{$invoice->client->company_name}}<br>
                            {{$invoice->client->first_name.' '.$invoice->client->last_name}}<br>
                            {{$invoice->client->email}}
                        </td>

                        <td class="invoice-right">
                            <strong>Invoice #: {{$invoice->invoice_number}}</strong><br>
                            Created: {{$invoice->created_at->toFormattedDateString()}}<br>
                            Due Date: {{$invoice->due_date->toFormattedDateString()}}
                        </td>

                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td colspan="4">
                Payment Method
            </td>

            {{--<td colspan="1">--}}
                {{--Check #--}}
            {{--</td>--}}
        </tr>

        <tr class="details">
            <td colspan="4">
                {{$invoice->payment_method}}
            </td>

            {{--<td colspan="1">--}}
                {{--1000--}}
            {{--</td>--}}
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Price
            </td>
            <td>
                Quantity
            </td>
            <td>
                Total
            </td>

        </tr>
        @if(count($invoice->items))
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{$item->description}}</td>
                    <td>${{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>${{$item->total}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="total">
            <td colspan="3">
                <strong>Total</strong>
            </td>

            <td>
                ${{$invoice_items_total}}
            </td>
        </tr>
    </table>
</div>
</body>
</html>
