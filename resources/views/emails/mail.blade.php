<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>

    <table class="table table-striped">
        <!--Table head-->

        <!--Table body-->
        <tbody>
            <tr>
                <th>
                    <p>
                        <bold>Name </bold>
                    </p>
                </th>
                <th>
                    <p>:</p>
                </th>
                <th>
                    <p style="font-weight: 400 !important">{{ $details['name'] }}
                    </p>
                </th>
            </tr>
            <tr>
                <th>
                    <p>
                        <bold>Email </bold>
                    </p>
                </th>
                <th>
                    <p>:</p>
                </th>
                <th>
                    <p style="font-weight: 400 !important">{{ $details['email'] }}
                    </p>
                </th>
            </tr>
            <tr>
                <th>
                    <p>
                        <bold>Subject </bold>
                    </p>
                </th>
                <th>
                    <p>:</p>
                </th>
                <th>
                    <p style="font-weight: 400 !important">{{ $details['subject'] }}
                    </p>
                </th>
            </tr>
            <tr>
                <th>
                    <p>
                        <bold>Message </bold>
                    </p>
                </th>
                <th>
                    <p>:</p>
                </th>
                <th>
                    <p style="font-weight: 400 !important">{{ $details['body'] }}
                    </p>
                </th>
            </tr>
        </tbody>
    </table>






    <p>Thank you</p>
</body>

</html>
