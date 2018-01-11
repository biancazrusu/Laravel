<html>
<head>
    <style>
        body{
            font-family: arial, sans-serif;
        }
        .questions{
            border-collapse: collapse;
            width: 100%;
        }

        .questions, .questionsTd {
            border: 1px solid black;
            text-align: left;
            font-size: 19px;
        }
        .questionsTd{
            color:#434547;
            padding: 5px;
        }
        .questionsTh{
            background-color: #ccc;
            padding: 5px;
        }
        p{
            font-size: 16px;
            padding: 0;
        }
        .logo-font-light{
            color: #000;
            font-family: 'VisbyCF-Light';
            font-size: 21px;
            line-height: 1;
        }
        .logo-font-bold{
            color: #00e777;
            font-family: 'VisbyCF-Bold';
            font-size: 21px;
            line-height: 1;
        }
        footer{
            position: absolute;
            right: 50%;
            margin-right: -100px;
            bottom: 0;
        }

    </style>
</head>
<body>
    <div style="margin:0 auto; width: 100%;">
        <div style="float: right;">
            <span class="logo-font-light">Create</span><br>
            <span class="logo-font-light">your</span>
            <span class="logo-font-bold">App.</span>
        </div>
        <div style="float: right;">
            <img style='display:inline;' src="design/images/rsz_lori_transparent_small.png" width="40px;" height="50px;">
        </div>
        <div style="float: left; font-size: 15px;">
            DATE: {{ $estimates[0]['text']->created_at }}<br>
            Estimate id: {{ $estimates[0]['text']->id }}<br>
            User id: {{ $estimates[0]['text']->user_id }}<br>
        </div>
    </div><br>
        <br>

    <div align="center" style="margin-top: 150px;"><h1>Estimate details</h1></div>
    <div style="width:100%; " align="center">
        <table align="center" class="questions">
            <thead>
                <tr>
                    <th class="questionsTh">Question</th>
                    <th class="questionsTh">Answers</th>
                    <th class="questionsTh">Price</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($estimates as $estimate)
                @foreach ($estimate['questions'] as $question)

                <?php $length = count($question['answers']); ?>

                <tr>
                    <td rowspan = "{{ $length }}" class="questionsTd">
                        {{ $question['question']->text }}
                    </td>
                    <td class="questionsTd">{{ $question['answers'][0]['id']->text }}</td>
                    <td class="questionsTd">{{ $question['answers'][0]['price']}}</td>
                </tr>
                <?php unset($question['answers'][0]); ?>
                    @foreach ($question['answers'] as $answer)
                    <tr>
                        <td class="questionsTd">
                            {{ $answer['id']->text }}
                        </td>
                        <td class="questionsTd">
                            {{ $answer['price'] }}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
            </div>
                <table style=" float: right; font-size: 24px; padding-top: 100px;">
                    <tr>
                        <td style="padding-right: 20px; font-size: 20px;"><strong>Your budget :</strong></td>
                        <td style="float: right; font-size: 20px;">{{ $estimate['text']->budget}}  &euro;</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 20px;"><strong>Total Price :</strong></td>
                        <td style="float: right;"><strong>{{ $estimate['totalPrice']}}  &euro;</strong></td>
                    </tr>
                </table>

            @endforeach
<footer >Thank you for your business!</footer>
</body>
</html>