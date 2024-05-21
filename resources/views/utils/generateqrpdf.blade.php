<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Referral Report</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link defer href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <style>
        body,
        html {
         
            height: 100%;
        }
        u {    
    border-bottom: 1px dotted #000;
    text-decoration: none;
}

        .page {
         
            /* Height of A4 paper */
            position: relative;
        }
        .table-striped tbody tr:nth-of-type(odd)
        {background-color:rgba(0,0,0,.05)}
        .table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table .table{background-color:#fff}
.th{
    text-align:left !important;
}
        .header-container {
            display: table;
            width: 100%;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
            text-align: right;
        }

        .currentDate {
            width: fit-content;
            text-align: right;
        }

        .col{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}
        .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
        .text-center{text-align:center!important}
        .font-weight-bold{font-weight:700!important}
        .figure-caption{font-size:90%;color:#6c757d}
        .figure {
            padding-top: 40px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 10mm;
            font-size: 12px;
            font-weight: lighter;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif

            /* Adjust according to your footer height */
            /* Your footer styles here */
        }
        .instructions {
            text-align: justify;
    font-style: italic;
    /* Add additional styling as needed */
}

.copyright {
    font-weight: lighter;
    /* Add additional styling as needed */
}
.liaison{
    text-align: right;
}
    </style>
</head>


<body class="font-sans antialiased">

    <div class="page">
        <div class="header-container">


            <span id="currentDate font-weight-bold font-italic"> Date: {{ $day }}</span>

        </div>
        {{-- <img src="..." class="img-fluid" alt="Responsive image"> --}}
        {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('http://google.com')) !!} "> --}}
        <div class="text-center">
            <figure class="figure text-center">
                <img src="data:image/png;base64, {!! $qr !!}">
                <figcaption class="figure-caption text-right">You can scan the QR code on your mobile app</figcaption>
            </figure>
        </div>
        <table class="table mx-auto table-striped" style="padding-top:50px">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Full Name</th>
                    <td>{{$patient->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Referral Id</th>
                    <td>{{$patient->card_number}}</td>
                </tr>
                <tr>
                    <th scope="row">Private Token</th>
                    <td>{{$token}}</td>
                </tr>
            
                <tr>
                    <th scope="row">Gender</th>
                    <td>{{$patient->gender->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Registering Center</th>
                    <td><u class="small">{{$patient->hospital->name}}</u></td>
                </tr>
               
              
                
                   
                


            </tbody>
        </table>
        <div class="footer bg-transparent border-success position-fixed">
       
            <div class="instructions">
                <div class="liaison">
                
                    <div class="copyright" >
                        <span class="font-weight-bold">Liaison Officer:</span>{{$patient->hospital->liaison->liaison_officer}}</div>
                    <div class="copyright" >
                        <span class="font-weight-bold">Phone Number:</span>{{$patient->hospital->liaison->phone_number}}</div>
    
                    
                </div>
            <em>Please use the mobile app of the Patient Referral Tracking App and scan the QR code to view your available appointments.</em>  </div>
            <div class="copyright">
                &copy; 2024 <span class="font-weight-bold">PRTS</span>
            </div>
        </div>
        
       
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
