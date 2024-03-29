<html>

<head>
    <title>Payment Receipt</title>
</head>
<style>
    body {
        font-family: 'verdana';
    }

    h2 {
        font-weight: 500;
        font-size: 20px;
        margin: 0px;
    }

    p {
        margin: 5px;
        line-height: 23px;
        font-size: 15px;
    }
</style>

<body onload="prints();">
    <table width="100%" style="margin:100px auto; border:1px solid #000" cellpadding="10">
        <tr>
            <td>
                <p><b>Receipt No: </b> <?php echo $payment->receipt_id; ?></p>
                <p><b>Receipt Date: </b> <?php echo date("d-m-Y H:i:s", strtotime($payment->created_at)); ?></p>
            </td>

            <td>
                <h2>Company Name</h2>
                <p>Demo Address<br />
                    Contact No: <br />
                    Email: </p>


            </td>
        </tr>

        <tr>
            <td width="50%">
                <table width="100%" cellpadding="5">

                    <tr>
                        <td>
                            <p>To,</p>
                            <p><b>Name:</b> <?php echo $tenant->tenant_name; ?></p>
                            <p><b>Mobile:</b> <?php echo $tenant->tenant_mobile; ?></p>
                            <p><b>Address:</b> <?php echo $tenant->address; ?></p>
                        </td>
                    </tr>
                </table>
            </td>

            <td>


            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" cellpadding="5">
                    <tr style="background-color: #333; color:white; text-align:center">
                        <td>Sr. No.</td>
                        <td>Particular(s)</td>
                        <td>Amount</td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #000">1</td>
                        <td style="border-bottom:1px solid #000">
                            <p><?php echo getDates($payment->rent_for, $payment->agreement_id) ?></p>
                            <p>Property: <?php echo $payment->property_name; ?> (<?php echo $payment->property_id; ?>)</p>

                        </td>
                        <td style="border-bottom:1px solid #000"><?php echo withoutGst($payment->total, $payment->netgst, $payment->tds); ?></td>
                    </tr>
                    <tr rowspan="2">
                        <td><b>Remarks:</b> <?php echo $payment->remarks; ?></td>
                        <td align="right">Previous Balance: (+)</td>
                        <td><?php echo $payment->previous_balance; ?></td>
                    </tr>
                    <tr>

                        <td></td>
                        <td align="right">GST (<?php echo $payment->gst ?>%): (+)</td>
                        <td><?php echo $payment->netgst; ?></td>
                    </tr>
                    <tr>

                        <td></td>
                        <td align="right">TDS (<?php echo $payment->tds_perc ?>%): (-)</td>
                        <td><?php echo $payment->tds; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Net Total:</td>
                        <td><?php echo $payment->total; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Paid: (-)</td>
                        <td><?php echo $payment->paying; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Balance:</td>
                        <td><?php echo $payment->balance; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>In Words:</b> <?php echo getIndianCurrency($payment->paying); ?> Only.</td>

                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top:1px solid #000"></td>
            <td style="border-top:1px solid #000; height:200px;">
                <p align="center">Authorized Signatory</p>
            </td>
        </tr>
    </table>
</body>

</html>