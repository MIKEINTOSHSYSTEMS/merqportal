<?php
// Display all errors and warnings
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "127.0.0.1";
$user = "merq_portal";
$pass = "merq_portal";
$dbname = "merq_portal";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Fetch users with position, department, and supervisor info
$sql = "
    SELECT 
        u.user_id, 
        u.employee_id,
        u.full_name,
        u.first_name,
        u.middle_name,
        u.last_name,
        u.email,    
        u.role,
        p.position_title, 
        d.department_name, 
        u.supervisor_id,
        s.full_name AS supervisor_name
    FROM users u
    LEFT JOIN positions p 
        ON u.position_id = p.position_id
    LEFT JOIN departments d 
        ON u.department_id = d.department_id
    LEFT JOIN users s 
        ON u.supervisor_id = s.user_id
    -- WHERE u.employee_id IS NOT NULL
    WHERE u.user_id NOT IN (1, 2, 3)
    ORDER BY u.full_name ASC;
";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MERQ Consultancy Employees Performance Evaluation Form V1.0</title>
    <link href="css/tabler.min.css" rel="stylesheet">
    <link href="css/tabler-vendors.min.css" rel="stylesheet">
    <link href="css/app.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/assets/images/icon-192.png">
    <link href="css/public.css" rel="stylesheet">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="420" />
    <style>
        body {
            background-color: #EFF3F6;
        }

        .legend {
            margin-top: 0;
        }

        .g-recaptcha {
            min-height: 78px;
        }

        .form-container {
            padding: 20px;
            border-radius: 0 0 4px 4px;
        }

        /*********** CSS Theme **********/

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,600);

        body {
            background-color: #000E27;
            /*#101e47;*/
            padding: 2px;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
        }

        .legend {
            font-family: "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: #515151;
        }

        .form-control {
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 400;
            height: 55px;
            border-radius: 3px;
            border-color: #d3d3d3;
        }

        .form-control:focus {
            border: 1px solid #2b8dd6;
            box-shadow: none;
            outline: 0 none;
        }

        .form-control::-webkit-input-placeholder {
            color: #797979;
        }

        .form-control:-moz-placeholder {
            color: #797979;
        }

        .form-control::-moz-placeholder {
            color: #797979;
        }

        .form-control:-ms-input-placeholder {
            color: #797979;
        }

        .control-label {
            font-weight: 600;
        }

        .btn {
            background-color: #2b8dd6;
            box-sizing: border-box !important;
            border: 0 !important;
            border-bottom: 3px solid rgba(0, 0, 0, 0.1) !important;
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 600;
            box-shadow: 0 0 0 !important;
            padding: 16px 32px;
        }

        .btn:hover,
        .btn:active,
        .btn:focus {
            background-color: #2b8dd6;
            opacity: 0.85;
            border: 0 !important;
            border-bottom: 3px solid rgba(0, 0, 0, 0.1) !important;
        }

        /*********** Theme Designer **********/
        .form-container {}

        #form-app {}

        #form-app .form-group {}

        #form-app .form-control {}

        #form-app .form-control:focus {}

        #form-app .btn.btn-primary {}

        #form-app .btn.btn-primary:hover,
        #form-app .btn.btn-primary:active,
        #form-app .btn.btn-primary:focus {}

        #form-app .btn.btn-default {}

        #form-app .btn.btn-default:hover,
        #form-app .btn.btn-default:active,
        #form-app .btn.btn-default:focus {}

        #form-app .btn.btn-warning {}

        #form-app .btn.btn-warning:hover,
        #form-app .btn.btn-warning:active,
        #form-app .btn.btn-warning:focus {}

        #form-app .btn.btn-danger {}

        #form-app .btn.btn-danger:hover,
        #form-app .btn.btn-danger:active,
        #form-app .btn.btn-danger:focus {}

        #form-app .btn.btn-info:hover,
        #form-app .btn.btn-info:active,
        #form-app .btn.btn-info:focus {}

        #form-app .form-label {}

        #form-app ::placeholder {}

        #form-app h1,
        #form-app h2,
        #form-app h3,
        #form-app h4,
        #form-app h5,
        #form-app h6,
        #form-app .legend {}

        #form-app p {}

        #form-app .form-text {}

        #form-app a {}

        #form-app a:hover {}

        #form-app .steps .step .stage,
        #form-app .steps .step:before,
        #form-app .steps .step:after {}

        #form-app .steps .step .stage {}

        #form-app .steps .step:after,
        #form-app .steps .step:before {}

        #form-app .steps .step.current .stage,
        #form-app .steps .step.current:after,
        #form-app .steps .step.current:before {}

        #form-app .steps .step.success .stage,
        #form-app .steps .step.success:after,
        #form-app .steps .step.success:before {}

        #form-app .steps .step .title {}

        #form-app .steps .step.current .title {}

        #form-app .steps .step.success .title {}

        .alert {}

        .alert-success {}

        .alert-danger {}

        .alert-info {}

        .alert-warning {}

        .has-error .form-control {}

        .has-error .form-text,
        .has-error .form-label,
        .has-error .radio,
        .has-error .checkbox,
        .has-error .radio-inline,
        .has-error .checkbox-inline,
        .has-error.radio label,
        .has-error.checkbox label,
        .has-error.radio-inline label,
        .has-error.checkbox-inline label {}

        .required .form-label:after,
        .required-control .form-label:after {}

        #recaptcha,
        .g-recaptcha {}

        .signature-pad {}

        .signature-pad canvas {}

        input[type=checkbox] {}

        input[type=checkbox]:checked {}

        input[type=checkbox]+label {}

        input[type=checkbox]:checked+label {}

        div:has(> input[type=checkbox]) {}

        input[type=radio] {}

        input[type=radio]:checked {}

        input[type=radio]+label {}

        input[type=radio]:checked+label {}

        div:has(> input[type=radio]) {}

        .btn.prev {}

        #form-app .btn.prev:hover,
        #form-app .btn.prev:active,
        #form-app .btn.prev:focus {}

        .btn.next {}

        #form-app .btn.next:hover,
        #form-app .btn.next:active,
        #form-app .btn.next:focus {}

        .progress {}

        .progress-bar {}

        .table {}

        .well {}

        label.form-label {
            font-size: 1.5rem;
            /* Similar size to <h2> */
            font-weight: bold;
            /* Headline weight */
            color: #003366;
            /* Dark blue (you can adjust the hex code) */
            display: block;
            /* Makes it behave like a heading */
            margin: 1em 0 0.5em;
            /* Adds spacing like a heading */
        }

        .radio input[type="radio"] {
            accent-color: #66b2ff;
            /* Light blue */
            width: 18px;
            /* Slightly bigger */
            height: 18px;
            border: 2px solid #66b2ff;
            /* Border thickness */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* merge borders into single lines */
            margin: 1em 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table th,
        table td {
            border: 1px solid #333;
            /* visible 1px border */
            padding: 8px 12px;
            text-align: left;
        }

        table th {
            background-color: #003366;
            /* dark blue header */
            color: #fff;
            /* white text */
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f6fc;
            /* light alternate row */
        }

        table tr:hover {
            background-color: #e0ecf9;
            /* light hover effect */
        }

        .selected-employee {
            margin: 12px 0;
            font-size: 1.1rem;
            font-weight: bold;
            color: #003366;
            text-align: center;
        }

        #supervisor-details {
            font-size: 0.95rem;
            font-weight: normal;
            color: #FF7700FF;
            margin-top: 6px;
        }

        /* Styled evaluation info section */
        .evaluation-info {
            margin-top: 1rem;
            padding: 1rem 1.5rem;
            border: 2px solid #0056b3;
            /* dark blue border */
            border-radius: 12px;
            background: #f0f8ff;
            /* light blue background */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        /* Each row inside the box */
        .evaluation-info .info-row {
            margin: 0.3rem 0;
            font-size: 1rem;
            color: #003366;
            /* dark navy text */
        }

        /* Highlighted labels */
        .evaluation-info .info-row::before {
            font-weight: bold;
            color: #002244;
        }
    </style>
    <script>
        var options = {
            id: 13,
            app: "\/\/formapp.merqconsultancy.org\/app",
            tracker: "js\/form.tracker.js",
            name: "#form-app",
            actionUrl: "https:\/\/formapp.merqconsultancy.org\/app\/f?id=13",
            validationUrl: "https:\/\/formapp.merqconsultancy.org\/app\/check?id=13",
            _csrf: "3yo2veoHxrKSLC1VbhVfFyO7UZcSfTn2es-SMK4vCqOOb3iJvFSyy6doQSIXVC1WaJYp_SERYNtOuaFY91lMkA==",
            resume: 1,
            text_direction: "ltr",
            autocomplete: 1,
            novalidate: 0,
            analytics: 1,
            confirmationType: 2,
            confirmationMessage: false,
            confirmationUrl: "https:\/\/app.merqconsultancy.org",
            confirmationSeconds: 7,
            confirmationAppend: 0,
            confirmationAlias: 0,
            showOnlyMessage: 1,
            redirectToUrl: 2,
            rules: [{
                    conditions: '{"all":[{"name":"radio_1","operator":"equalTo","value":"Other"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"text_1"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"selectlist_4","operator":"equalTo","value":"Monthly"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_3"}]}]},{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_5"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"selectlist_4","operator":"equalTo","value":"Quarterly"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_6"}]}]},{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_5"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"selectlist_4","operator":"equalTo","value":"Biannually"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_7"}]}]},{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_5"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"selectlist_4","operator":"equalTo","value":"Annually"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_5"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"selectlist_4","operator":"isPresent","value":""}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"selectlist_5"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"radio_1","operator":"equalTo","value":"Supervisor"},{"name":"radio_1","operator":"equalTo","value":"Self-evaluation"},{"name":"radio_1","operator":"equalTo","value":"Other"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"text_2"}]}]},{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"email_1"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"radio_1","operator":"notEqualTo","value":"Supervisor"},{"name":"radio_1","operator":"notEqualTo","value":"Self-evaluation"},{"name":"radio_1","operator":"notEqualTo","value":"Other"}]}',
                    actions: '[{"name":"action-select","value":"toHide","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"text_2"}]}]},{"name":"action-select","value":"toHide","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"email_1"}]}]}]',
                    opposite: true,
                },
                {
                    conditions: '{"all":[{"name":"radio_1","operator":"equalTo","value":"Self-evaluation"}]}',
                    actions: '[{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"textarea_18"}]}]},{"name":"action-select","value":"toShow","fields":[{"name":"target","value":"field","fields":[{"name":"targetField","value":"textarea_19"}]}]}]',
                    opposite: true,
                },
            ],
            fieldIds: [
                "radio_1_0",
                "radio_1_1",
                "radio_1_2",
                "radio_1_3",
                "radio_1_4",
                "text_1",
                "text_2",
                "email_1",
                "date_1",
                "selectlist_1",
                "selectlist_2",
                "selectlist_4",
                "selectlist_3",
                "selectlist_6",
                "selectlist_7",
                "selectlist_5",
                "matrix_1_0_0",
                "matrix_1_0_1",
                "matrix_1_0_2",
                "matrix_1_0_3",
                "matrix_1_0_4",
                "matrix_1_0_5",
                "matrix_1_1_0",
                "matrix_1_1_1",
                "matrix_1_1_2",
                "matrix_1_1_3",
                "matrix_1_1_4",
                "matrix_1_1_5",
                "matrix_1_2_0",
                "matrix_1_2_1",
                "matrix_1_2_2",
                "matrix_1_2_3",
                "matrix_1_2_4",
                "matrix_1_2_5",
                "matrix_1_3_0",
                "matrix_1_3_1",
                "matrix_1_3_2",
                "matrix_1_3_3",
                "matrix_1_3_4",
                "matrix_1_3_5",
                "matrix_1_4_0",
                "matrix_1_4_1",
                "matrix_1_4_2",
                "matrix_1_4_3",
                "matrix_1_4_4",
                "matrix_1_4_5",
                "textarea_1",
                "textarea_2",
                "matrix_2_0_0",
                "matrix_2_0_1",
                "matrix_2_0_2",
                "matrix_2_0_3",
                "matrix_2_0_4",
                "matrix_2_0_5",
                "matrix_2_1_0",
                "matrix_2_1_1",
                "matrix_2_1_2",
                "matrix_2_1_3",
                "matrix_2_1_4",
                "matrix_2_1_5",
                "matrix_2_2_0",
                "matrix_2_2_1",
                "matrix_2_2_2",
                "matrix_2_2_3",
                "matrix_2_2_4",
                "matrix_2_2_5",
                "matrix_2_3_0",
                "matrix_2_3_1",
                "matrix_2_3_2",
                "matrix_2_3_3",
                "matrix_2_3_4",
                "matrix_2_3_5",
                "matrix_2_4_0",
                "matrix_2_4_1",
                "matrix_2_4_2",
                "matrix_2_4_3",
                "matrix_2_4_4",
                "matrix_2_4_5",
                "textarea_3",
                "textarea_4",
                "matrix_3_0_0",
                "matrix_3_0_1",
                "matrix_3_0_2",
                "matrix_3_0_3",
                "matrix_3_0_4",
                "matrix_3_0_5",
                "matrix_3_1_0",
                "matrix_3_1_1",
                "matrix_3_1_2",
                "matrix_3_1_3",
                "matrix_3_1_4",
                "matrix_3_1_5",
                "matrix_3_2_0",
                "matrix_3_2_1",
                "matrix_3_2_2",
                "matrix_3_2_3",
                "matrix_3_2_4",
                "matrix_3_2_5",
                "matrix_3_3_0",
                "matrix_3_3_1",
                "matrix_3_3_2",
                "matrix_3_3_3",
                "matrix_3_3_4",
                "matrix_3_3_5",
                "matrix_3_4_0",
                "matrix_3_4_1",
                "matrix_3_4_2",
                "matrix_3_4_3",
                "matrix_3_4_4",
                "matrix_3_4_5",
                "textarea_5",
                "textarea_6",
                "matrix_4_0_0",
                "matrix_4_0_1",
                "matrix_4_0_2",
                "matrix_4_0_3",
                "matrix_4_0_4",
                "matrix_4_0_5",
                "matrix_4_1_0",
                "matrix_4_1_1",
                "matrix_4_1_2",
                "matrix_4_1_3",
                "matrix_4_1_4",
                "matrix_4_1_5",
                "matrix_4_2_0",
                "matrix_4_2_1",
                "matrix_4_2_2",
                "matrix_4_2_3",
                "matrix_4_2_4",
                "matrix_4_2_5",
                "matrix_4_3_0",
                "matrix_4_3_1",
                "matrix_4_3_2",
                "matrix_4_3_3",
                "matrix_4_3_4",
                "matrix_4_3_5",
                "matrix_4_4_0",
                "matrix_4_4_1",
                "matrix_4_4_2",
                "matrix_4_4_3",
                "matrix_4_4_4",
                "matrix_4_4_5",
                "textarea_7",
                "textarea_8",
                "matrix_5_0_0",
                "matrix_5_0_1",
                "matrix_5_0_2",
                "matrix_5_0_3",
                "matrix_5_0_4",
                "matrix_5_0_5",
                "matrix_5_1_0",
                "matrix_5_1_1",
                "matrix_5_1_2",
                "matrix_5_1_3",
                "matrix_5_1_4",
                "matrix_5_1_5",
                "matrix_5_2_0",
                "matrix_5_2_1",
                "matrix_5_2_2",
                "matrix_5_2_3",
                "matrix_5_2_4",
                "matrix_5_2_5",
                "matrix_5_3_0",
                "matrix_5_3_1",
                "matrix_5_3_2",
                "matrix_5_3_3",
                "matrix_5_3_4",
                "matrix_5_3_5",
                "matrix_5_4_0",
                "matrix_5_4_1",
                "matrix_5_4_2",
                "matrix_5_4_3",
                "matrix_5_4_4",
                "matrix_5_4_5",
                "textarea_9",
                "textarea_10",
                "matrix_6_0_0",
                "matrix_6_0_1",
                "matrix_6_0_2",
                "matrix_6_0_3",
                "matrix_6_0_4",
                "matrix_6_0_5",
                "matrix_6_1_0",
                "matrix_6_1_1",
                "matrix_6_1_2",
                "matrix_6_1_3",
                "matrix_6_1_4",
                "matrix_6_1_5",
                "matrix_6_2_0",
                "matrix_6_2_1",
                "matrix_6_2_2",
                "matrix_6_2_3",
                "matrix_6_2_4",
                "matrix_6_2_5",
                "matrix_6_3_0",
                "matrix_6_3_1",
                "matrix_6_3_2",
                "matrix_6_3_3",
                "matrix_6_3_4",
                "matrix_6_3_5",
                "matrix_6_4_0",
                "matrix_6_4_1",
                "matrix_6_4_2",
                "matrix_6_4_3",
                "matrix_6_4_4",
                "matrix_6_4_5",
                "textarea_11",
                "textarea_12",
                "matrix_7_0_0",
                "matrix_7_0_1",
                "matrix_7_0_2",
                "matrix_7_0_3",
                "matrix_7_0_4",
                "matrix_7_0_5",
                "matrix_7_1_0",
                "matrix_7_1_1",
                "matrix_7_1_2",
                "matrix_7_1_3",
                "matrix_7_1_4",
                "matrix_7_1_5",
                "matrix_7_2_0",
                "matrix_7_2_1",
                "matrix_7_2_2",
                "matrix_7_2_3",
                "matrix_7_2_4",
                "matrix_7_2_5",
                "matrix_7_3_0",
                "matrix_7_3_1",
                "matrix_7_3_2",
                "matrix_7_3_3",
                "matrix_7_3_4",
                "matrix_7_3_5",
                "textarea_13",
                "textarea_14",
                "matrix_8_0_0",
                "matrix_8_0_1",
                "matrix_8_0_2",
                "matrix_8_0_3",
                "matrix_8_0_4",
                "matrix_8_0_5",
                "matrix_8_1_0",
                "matrix_8_1_1",
                "matrix_8_1_2",
                "matrix_8_1_3",
                "matrix_8_1_4",
                "matrix_8_1_5",
                "matrix_8_2_0",
                "matrix_8_2_1",
                "matrix_8_2_2",
                "matrix_8_2_3",
                "matrix_8_2_4",
                "matrix_8_2_5",
                "matrix_8_3_0",
                "matrix_8_3_1",
                "matrix_8_3_2",
                "matrix_8_3_3",
                "matrix_8_3_4",
                "matrix_8_3_5",
                "matrix_8_4_0",
                "matrix_8_4_1",
                "matrix_8_4_2",
                "matrix_8_4_3",
                "matrix_8_4_4",
                "matrix_8_4_5",
                "textarea_15",
                "textarea_16",
                "matrix_9_0_0",
                "matrix_9_0_1",
                "matrix_9_0_2",
                "matrix_9_0_3",
                "matrix_9_0_4",
                "textarea_17",
                "textarea_18",
                "textarea_19",
                "button_1",
            ],
            submitted: false,
            runOppositeActions: true,
            skips: [],
            reCaptchaVersion: "2",
            reCaptchaSiteKey: "your_site_key",
            defaultValues: false,
            i18n: {
                complete: "Complete",
                unexpectedError: "An unexpected error has occurred. Please retry later.",
            },
        };
    </script>
</head>

<body class="public app app-embed" style="min-height: 150px;">
    <div class="container p-5">
        <div class="row">
            <div class="col-12 col-xl-8 offset-xl-2 col-xll-10 col-xll-1">
                <div class="card">
                    <div class="card-header bg-muted" style="padding: 10px 25px">
                        <h3 class="card-title">
                            <!-- Brand -->

                            <a class="navbar-brand" href="/" title="MERQ Consultancy Employee's Performance Evaluation">
                                <img src="images/merqlogo.png" height="40px" alt="MERQ Consultancy" title="MERQ Consultancy"></a>
                        </h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-container">
                            <div id="messages"></div>
                            <form action="https://formapp.merqconsultancy.org/app/f?id=13" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form-app">

                                <!-- Steps -->
                                <div class="steps">
                                    <div class="step current">
                                        <div class="stage">1</div>
                                        <div class="title">Introduction</div>
                                    </div>
                                    <div class="step">
                                        <div class="stage">2</div>
                                        <div class="title">Perspective</div>
                                    </div>
                                    <div class="step">
                                        <div class="stage">3</div>
                                        <div class="title">Instructions</div>
                                    </div>
                                    <div class="step">
                                        <div class="stage">4</div>
                                        <div class="title">Evaluation</div>
                                    </div>
                                    <div class="step">
                                        <div class="stage">5</div>
                                        <div class="title">Overall Assessment</div>
                                    </div>
                                </div>
                                <!-- Employee display 
                                <div id="selected-employee" class="selected-employee"></div>
                            -->

                                <!-- Evaluation Info -->
                                <div id="evaluation-info" class="evaluation-info">
                                    <div id="employee-display" class="info-row"></div>
                                    <div id="perspective-display" class="info-row"></div>
                                    <div id="supervisor-details" class="info-row" style="display:none;"></div>
                                </div>



                                <fieldset class="row">

                                    <!-- Snippet -->
                                    <div class="snippet col-12">
                                        <p><img class="attachment-full size-full" style="float: left;" src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" sizes="auto, (max-width: 600px) 100vw, 600px" srcset="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png 600w, https://merqconsultancy.org/wp-content/uploads/2017/07/merq-300x113.png 300w" alt="" width="215" height="81" loading="lazy" /></p>
                                    </div>

                                    <!-- Heading -->
                                    <div class="col-12">
                                        <h1>MERQ Consultancy Pvt.Ltd.Co.,</h1>
                                    </div>

                                    <!-- Heading -->
                                    <div class="col-12">
                                        <h2>Employee/Staff Evaluation System</h2>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>V1.0</p>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Snippet -->
                                    <div class="snippet col-12">
                                        <h2 data-start="110" data-end="131"><strong data-start="113" data-end="129">Introduction</strong></h2>
                                        <p data-start="133" data-end="475">The <strong data-start="137" data-end="194">MERQ Consultancy Employee Performance Evaluation Form</strong> is designed to provide a structured, fair, and comprehensive assessment of employee performance. This evaluation serves as a valuable tool to strengthen organizational effectiveness, foster professional growth, and ensure alignment with MERQ Consultancy&rsquo;s mission and standards.</p>
                                        <p data-start="477" data-end="757">The form is intended for use by supervisors, managers, or designated evaluators to assess staff performance across multiple core competencies, including technical expertise, work quality, productivity, communication, teamwork, problem-solving, professionalism, and adaptability.</p>
                                        <p data-start="759" data-end="788">Evaluators are expected to:</p>
                                        <ul data-start="789" data-end="1134">
                                            <li data-start="789" data-end="859">
                                                <p data-start="791" data-end="859">Provide an objective and evidence-based assessment of performance.</p>
                                            </li>
                                            <li data-start="860" data-end="941">
                                                <p data-start="862" data-end="941">Use the standardized 5-point rating scale to ensure consistency and fairness.</p>
                                            </li>
                                            <li data-start="942" data-end="1039">
                                                <p data-start="944" data-end="1039">Support ratings with specific examples, identifying both strengths and areas for improvement.</p>
                                            </li>
                                            <li data-start="1040" data-end="1134">
                                                <p data-start="1042" data-end="1134">Recommend actionable development goals to guide future performance and career progression.</p>
                                            </li>
                                        </ul>
                                        <p data-start="1136" data-end="1505">This process is not only a means of measuring past performance but also a platform for open dialogue, constructive feedback, and the development of strategies for continuous improvement. By completing this evaluation thoroughly and thoughtfully, evaluators contribute to a culture of accountability, professional excellence, and mutual growth within MERQ Consultancy.<br /><br />If you are ready you can <strong>continue</strong> to the next Section.<br /><br /><strong><span style="text-decoration: underline;">NOTE</span>: This is evaluation is confidential and will not share any personal information or disclose your identity to the person you are evaluating!</strong><br /><br />Thank you for your time and efforts!</p>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Page Break -->
                                    <div class="form-action col-xs-12"><button type="button" class="btn btn-primary next">Get Started</button></div>
                                </fieldset>
                                <fieldset class="row">

                                    <!-- Radio -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="radio_1">Evaluation perspective</label>
                                            <p class="form-text">I am filling this evaluation as:</p>
                                            <div class="form-check">
                                                <input type="radio" name="radio_1" id="radio_1_0" class="form-check-input" value="Supervisor" data-alias="">
                                                <label for="radio_1_0" class="form-check-label">
                                                    Supervisor
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="radio_1" id="radio_1_1" class="form-check-input" value="Subordinate" data-alias="">
                                                <label for="radio_1_1" class="form-check-label">
                                                    Subordinate
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="radio_1" id="radio_1_2" class="form-check-input" value="Colleague" data-alias="" checked>
                                                <label for="radio_1_2" class="form-check-label">
                                                    Colleague
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="radio_1" id="radio_1_3" class="form-check-input" value="Self-evaluation" data-alias="">
                                                <label for="radio_1_3" class="form-check-label">
                                                    Self-evaluation
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="radio_1" id="radio_1_4" class="form-check-input" value="Other" data-alias="">
                                                <label for="radio_1_4" class="form-check-label">
                                                    Other
                                                </label>
                                            </div>
                                            <span id="radio_1"></span>

                                        </div>
                                    </div>

                                    <!-- Text -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="text_1">Other</label>
                                            <input type="text" id="text_1" name="text_1" value="" data-alias="" placeholder="If Other Specify" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="date_1">Date of Evaluation</label>
                                            <p class="form-text">Current Date</p>
                                            <input type="date" id="date_1" name="date_1" value="" data-alias="" class="form-control">


                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>This Evaluation is for:</p>
                                    </div>

                                    <!-- Employee Name -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="selectlist_1">Employee Name</label>
                                            <p class="form-text">Select the employee/staff you want to evaluate</p>
                                            <select id="selectlist_1" name="selectlist_1" class="form-select" required>
                                                <option value="" disabled selected>Please Select</option>
                                                <?php foreach ($users as $u): ?>
                                                    <option value="<?= htmlspecialchars($u['user_id']) ?>">
                                                        <?= htmlspecialchars($u['full_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Employee Position -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="selectlist_2">Employee Position</label>
                                            <input type="text" id="selectlist_2" name="selectlist_2" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <!-- Department -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="department">Department</label>
                                            <input type="text" id="department" name="department" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <span>This is a confidential evaluation and your identity will not be disclosed to the person you are evaluating!</span>
                                    <!-- Conditional Evaluator Name -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="text_2">Evaluator Name</label>
                                            <input type="text" id="text_2" name="text_2" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <!-- Conditional Evaluator Email -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email_1">Evaluator Email</label>
                                            <input type="email" id="email_1" name="email_1" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Evaluator Name -->
                                    <!--
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="text_2">Evaluator</label>
                                            <input type="text" id="text_2" name="text_2" value="" data-alias="" placeholder="Please enter your First Name Middle Name Last Name here" class="form-control">
                                        </div>
                                    </div>
                                                -->

                                    <!-- Evaluator Email -->
                                    <!--
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="email_1">Email</label>
                                            <p class="form-text">Please enter your work email ending with @merqconsultancy.org</p>
                                            <input type="email" id="email_1" name="email_1" value="" data-alias="" placeholder="youremail@merqconsultancy.org" class="form-control">
                                        </div>
                                    </div>
                                                -->

                                    <!-- Select List -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="selectlist_4">Performance Review Period</label>
                                            <p class="form-text">Select the period which this evaluation is for</p>
                                            <select id="selectlist_4" name="selectlist_4[]" data-alias="" class="form-select">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Monthly" selected>Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Biannually">Biannually</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Select List -->
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class=" form-label" for="selectlist_3">Month</label>
                                            <p class="form-text">Select the Month which applies for the period</p>
                                            <select id="selectlist_3" name="selectlist_3[]" data-alias="" class="form-select">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September" selected>September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Select List -->
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class=" form-label" for="selectlist_6">Quarter</label>
                                            <p class="form-text">Select the Quarter which applies for the period</p>
                                            <select id="selectlist_6" name="selectlist_6[]" data-alias="" class="form-select">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Q1">Q1</option>
                                                <option value="Q2">Q2</option>
                                                <option value="Q3" selected>Q3</option>
                                                <option value="Q4">Q4</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Select List -->
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class=" form-label" for="selectlist_7">Period Range</label>
                                            <p class="form-text">Select a Biannual period range for which this evaluation refers to</p>
                                            <select id="selectlist_7" name="selectlist_7[]" data-alias="" class="form-select">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="January - June">January - June</option>
                                                <option value="July - December" selected>July - December</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Select List -->
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class=" form-label" for="selectlist_5">Year</label>
                                            <p class="form-text">Select the Year which applies for the period</p>
                                            <select id="selectlist_5" name="selectlist_5[]" data-alias="" class="form-select">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="2025" selected>2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Page Break -->
                                    <div class="form-action col-xs-12"><button type="button" class="btn btn-default me-1 prev">Go to Introduction</button> <button type="button" class="btn btn-primary next">Continue to Instructions</button></div>
                                </fieldset>
                                <fieldset class="row">

                                    <!-- Heading -->
                                    <div class="col-12">
                                        <h2>Instructions</h2>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>This evaluation aims to strengthen organizational performance through assessing the performance of the staff periodically. </p>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>Rate performance on each criterion using the 5-point scale:</p>
                                    </div>

                                    <!-- Snippet -->
                                    <div class="snippet col-12">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td width="60">
                                                        <p><strong>Scale</strong></p>
                                                    </td>
                                                    <td width="174">
                                                        <p><strong>Meaning of the Scale</strong></p>
                                                    </td>
                                                    <td width="342">
                                                        <p><strong>Description</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>1</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Needs Significant Improvement</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>Performance consistently falls below expectations</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>2</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Developing</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>Performance occasionally meets expectations but is inconsistent</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>3</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Meets Expectations</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>Performance consistently meets job requirements</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>4</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Exceeds Expectations</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>Performance frequently exceeds job requirements</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>5</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Outstanding</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>Performance consistently exceeds job requirements in all areas</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="60">
                                                        <p>NA</p>
                                                    </td>
                                                    <td width="174">
                                                        <p>Not Applicable</p>
                                                    </td>
                                                    <td width="342">
                                                        <p>There is no information to rate the individual.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>• Provide strengths and areas of improvement under each section of evaluation in a way that supports ratings</p>
                                    </div>

                                    <!-- Paragraph Text -->
                                    <div class="col-12">
                                        <p>

                                            • Complete all sections of the evaluation and provide detailed information as needed.
                                        </p>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Page Break -->
                                    <div class="form-action col-xs-12"><button type="button" class="btn btn-default me-1 prev">Go to Perspectives</button> <button type="button" class="btn btn-primary next">Start Evaluation</button></div>
                                </fieldset>
                                <fieldset class="row">

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_1" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_1" class="form-label">Job Knowledge and Technical Skills</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_1_0">Demonstrates knowledge required for position</label>
                                                        </th>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_0" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="1" value="1">
                                                                <label for="matrix_1_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_1" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="2" value="2">
                                                                <label for="matrix_1_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_2" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="3" value="3">
                                                                <label for="matrix_1_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_3" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="4" value="4">
                                                                <label for="matrix_1_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_4" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="5" value="5">
                                                                <label for="matrix_1_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_1 matrix_1_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_1_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_0" id="matrix_1_0_5" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Demonstrates knowledge required for position" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_1_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_1_1">Applies technical skills effectively</label>
                                                        </th>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_0" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_1_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_1" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_1_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_2" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_1_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_3" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_1_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_4" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_1_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_2 matrix_1_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_1_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_1" id="matrix_1_1_5" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Applies technical skills effectively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_1_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_1_2">Uses relevant software/systems proficiently</label>
                                                        </th>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_0" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="1" value="1">
                                                                <label for="matrix_1_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_1" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="2" value="2">
                                                                <label for="matrix_1_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_2" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="3" value="3">
                                                                <label for="matrix_1_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_3" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="4" value="4">
                                                                <label for="matrix_1_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_4" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="5" value="5">
                                                                <label for="matrix_1_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_3 matrix_1_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_1_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_2" id="matrix_1_2_5" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Uses relevant software/systems proficiently" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_1_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_1_3">Understands department procedures</label>
                                                        </th>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_0" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="1" value="1">
                                                                <label for="matrix_1_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_1" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="2" value="2">
                                                                <label for="matrix_1_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_2" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="3" value="3">
                                                                <label for="matrix_1_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_3" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="4" value="4">
                                                                <label for="matrix_1_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_4" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="5" value="5">
                                                                <label for="matrix_1_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_4 matrix_1_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_1_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_3" id="matrix_1_3_5" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Understands department procedures" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_1_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_1_4">Stays current with job-related knowledge</label>
                                                        </th>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_0" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="1" value="1">
                                                                <label for="matrix_1_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_1" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="2" value="2">
                                                                <label for="matrix_1_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_2" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="3" value="3">
                                                                <label for="matrix_1_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_3" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="4" value="4">
                                                                <label for="matrix_1_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_4" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="5" value="5">
                                                                <label for="matrix_1_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_1_q_5 matrix_1_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_1_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_1_4" id="matrix_1_4_5" data-matrix-id="matrix_1" data-matrix-label="Job Knowledge and Technical Skills" data-matrix-question="Stays current with job-related knowledge" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_1_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_1">Strengths</label>
                                            <textarea id="textarea_1" name="textarea_1" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_2">Areas of improvement</label>
                                            <textarea id="textarea_2" name="textarea_2" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_2" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_2" class="form-label">Quality of Work</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_2_0">Produces accurate work</label>
                                                        </th>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_0" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="1" value="1">
                                                                <label for="matrix_2_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_1" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="2" value="2">
                                                                <label for="matrix_2_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_2" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="3" value="3">
                                                                <label for="matrix_2_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_3" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="4" value="4">
                                                                <label for="matrix_2_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_4" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="5" value="5">
                                                                <label for="matrix_2_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_1 matrix_2_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_2_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_0" id="matrix_2_0_5" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Produces accurate work" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_2_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_2_1">Pays attention to detail</label>
                                                        </th>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_0" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="1" value="1">
                                                                <label for="matrix_2_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_1" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="2" value="2">
                                                                <label for="matrix_2_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_2" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="3" value="3">
                                                                <label for="matrix_2_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_3" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="4" value="4">
                                                                <label for="matrix_2_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_4" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="5" value="5">
                                                                <label for="matrix_2_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_2 matrix_2_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_2_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_1" id="matrix_2_1_5" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Pays attention to detail" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_2_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_2_2">Meets quality standards</label>
                                                        </th>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_0" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="1" value="1">
                                                                <label for="matrix_2_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_1" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="2" value="2">
                                                                <label for="matrix_2_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_2" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="3" value="3">
                                                                <label for="matrix_2_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_3" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="4" value="4">
                                                                <label for="matrix_2_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_4" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="5" value="5">
                                                                <label for="matrix_2_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_3 matrix_2_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_2_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_2" id="matrix_2_2_5" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Meets quality standards" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_2_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_2_3">Organizes work effectively</label>
                                                        </th>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_0" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_2_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_1" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_2_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_2" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_2_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_3" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_2_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_4" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_2_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_4 matrix_2_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_2_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_3" id="matrix_2_3_5" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Organizes work effectively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_2_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_2_4">Follows through on tasks</label>
                                                        </th>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_0" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="1" value="1">
                                                                <label for="matrix_2_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_1" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="2" value="2">
                                                                <label for="matrix_2_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_2" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="3" value="3">
                                                                <label for="matrix_2_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_3" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="4" value="4">
                                                                <label for="matrix_2_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_4" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="5" value="5">
                                                                <label for="matrix_2_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_2_q_5 matrix_2_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_2_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_2_4" id="matrix_2_4_5" data-matrix-id="matrix_2" data-matrix-label="Quality of Work" data-matrix-question="Follows through on tasks" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_2_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_3">Strengths</label>
                                            <textarea id="textarea_3" name="textarea_3" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_4">Areas of improvement</label>
                                            <textarea id="textarea_4" name="textarea_4" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_3" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_3" class="form-label">Productivity and Efficiency</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_3_0">Completes work in a timely manner</label>
                                                        </th>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_0" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="1" value="1">
                                                                <label for="matrix_3_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_1" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="2" value="2">
                                                                <label for="matrix_3_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_2" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="3" value="3">
                                                                <label for="matrix_3_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_3" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="4" value="4">
                                                                <label for="matrix_3_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_4" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="5" value="5">
                                                                <label for="matrix_3_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_1 matrix_3_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_3_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_0" id="matrix_3_0_5" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Completes work in a timely manner" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_3_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_3_1">Manages multiple priorities effectively</label>
                                                        </th>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_0" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_3_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_1" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_3_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_2" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_3_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_3" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_3_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_4" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_3_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_2 matrix_3_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_3_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_1" id="matrix_3_1_5" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Manages multiple priorities effectively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_3_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_3_2">Uses resources efficiently</label>
                                                        </th>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_0" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="1" value="1">
                                                                <label for="matrix_3_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_1" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="2" value="2">
                                                                <label for="matrix_3_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_2" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="3" value="3">
                                                                <label for="matrix_3_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_3" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="4" value="4">
                                                                <label for="matrix_3_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_4" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="5" value="5">
                                                                <label for="matrix_3_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_3 matrix_3_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_3_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_2" id="matrix_3_2_5" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Uses resources efficiently" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_3_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_3_3">Meets deadlines consistently</label>
                                                        </th>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_0" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="1" value="1">
                                                                <label for="matrix_3_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_1" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="2" value="2">
                                                                <label for="matrix_3_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_2" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="3" value="3">
                                                                <label for="matrix_3_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_3" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="4" value="4">
                                                                <label for="matrix_3_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_4" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="5" value="5">
                                                                <label for="matrix_3_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_4 matrix_3_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_3_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_3" id="matrix_3_3_5" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Meets deadlines consistently" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_3_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_3_4">Maintains appropriate workload</label>
                                                        </th>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_0" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="1" value="1">
                                                                <label for="matrix_3_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_1" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="2" value="2">
                                                                <label for="matrix_3_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_2" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="3" value="3">
                                                                <label for="matrix_3_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_3" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="4" value="4">
                                                                <label for="matrix_3_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_4" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="5" value="5">
                                                                <label for="matrix_3_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_3_q_5 matrix_3_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_3_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_3_4" id="matrix_3_4_5" data-matrix-id="matrix_3" data-matrix-label="Productivity and Efficiency" data-matrix-question="Maintains appropriate workload" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_3_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_5">Strengths</label>
                                            <textarea id="textarea_5" name="textarea_5" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_6">Areas of improvement</label>
                                            <textarea id="textarea_6" name="textarea_6" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_4" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_4" class="form-label">Communication Skills</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_4_0">Communicates clearly in writing</label>
                                                        </th>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_0" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="1" value="1">
                                                                <label for="matrix_4_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_1" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="2" value="2">
                                                                <label for="matrix_4_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_2" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="3" value="3">
                                                                <label for="matrix_4_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_3" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="4" value="4">
                                                                <label for="matrix_4_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_4" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="5" value="5">
                                                                <label for="matrix_4_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_1 matrix_4_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_4_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_0" id="matrix_4_0_5" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates clearly in writing" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_4_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_4_1">Communicates effectively verbally</label>
                                                        </th>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_0" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="1" value="1">
                                                                <label for="matrix_4_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_1" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="2" value="2">
                                                                <label for="matrix_4_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_2" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="3" value="3">
                                                                <label for="matrix_4_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_3" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="4" value="4">
                                                                <label for="matrix_4_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_4" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="5" value="5">
                                                                <label for="matrix_4_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_2 matrix_4_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_4_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_1" id="matrix_4_1_5" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates effectively verbally" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_4_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_4_2">Listens attentively</label>
                                                        </th>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_0" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_4_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_1" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_4_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_2" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_4_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_3" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_4_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_4" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_4_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_3 matrix_4_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_4_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_2" id="matrix_4_2_5" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Listens attentively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_4_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_4_3">Responds to inquiries promptly</label>
                                                        </th>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_0" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="1" value="1">
                                                                <label for="matrix_4_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_1" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="2" value="2">
                                                                <label for="matrix_4_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_2" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="3" value="3">
                                                                <label for="matrix_4_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_3" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="4" value="4">
                                                                <label for="matrix_4_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_4" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="5" value="5">
                                                                <label for="matrix_4_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_4 matrix_4_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_4_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_3" id="matrix_4_3_5" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Responds to inquiries promptly" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_4_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_4_4">Communicates professionally</label>
                                                        </th>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_0" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="1" value="1">
                                                                <label for="matrix_4_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_1" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="2" value="2">
                                                                <label for="matrix_4_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_2" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="3" value="3">
                                                                <label for="matrix_4_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_3" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="4" value="4">
                                                                <label for="matrix_4_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_4" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="5" value="5">
                                                                <label for="matrix_4_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_4_q_5 matrix_4_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_4_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_4_4" id="matrix_4_4_5" data-matrix-id="matrix_4" data-matrix-label="Communication Skills" data-matrix-question="Communicates professionally" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_4_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_7">Strengths</label>
                                            <textarea id="textarea_7" name="textarea_7" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_8">Areas of improvement</label>
                                            <textarea id="textarea_8" name="textarea_8" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_5" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_5" class="form-label">Teamwork and Collaboration</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_5_0">Works cooperatively with others</label>
                                                        </th>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_0" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="1" value="1">
                                                                <label for="matrix_5_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_1" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="2" value="2">
                                                                <label for="matrix_5_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_2" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="3" value="3">
                                                                <label for="matrix_5_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_3" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="4" value="4">
                                                                <label for="matrix_5_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_4" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="5" value="5">
                                                                <label for="matrix_5_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_1 matrix_5_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_5_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_0" id="matrix_5_0_5" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Works cooperatively with others" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_5_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_5_1">Contributes to team goals</label>
                                                        </th>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_0" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="1" value="1">
                                                                <label for="matrix_5_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_1" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="2" value="2">
                                                                <label for="matrix_5_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_2" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="3" value="3">
                                                                <label for="matrix_5_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_3" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="4" value="4">
                                                                <label for="matrix_5_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_4" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="5" value="5">
                                                                <label for="matrix_5_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_2 matrix_5_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_5_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_1" id="matrix_5_1_5" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Contributes to team goals" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_5_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_5_2">Shares information appropriately</label>
                                                        </th>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_0" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="1" value="1">
                                                                <label for="matrix_5_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_1" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="2" value="2">
                                                                <label for="matrix_5_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_2" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="3" value="3">
                                                                <label for="matrix_5_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_3" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="4" value="4">
                                                                <label for="matrix_5_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_4" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="5" value="5">
                                                                <label for="matrix_5_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_3 matrix_5_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_5_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_2" id="matrix_5_2_5" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Shares information appropriately" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_5_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_5_3">Respects diverse perspectives</label>
                                                        </th>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_0" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="1" value="1">
                                                                <label for="matrix_5_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_1" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="2" value="2">
                                                                <label for="matrix_5_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_2" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="3" value="3">
                                                                <label for="matrix_5_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_3" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="4" value="4">
                                                                <label for="matrix_5_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_4" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="5" value="5">
                                                                <label for="matrix_5_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_4 matrix_5_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_5_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_3" id="matrix_5_3_5" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Respects diverse perspectives" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_5_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_5_4">Supports colleagues</label>
                                                        </th>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_0" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="1" value="1">
                                                                <label for="matrix_5_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_1" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="2" value="2">
                                                                <label for="matrix_5_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_2" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="3" value="3">
                                                                <label for="matrix_5_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_3" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="4" value="4">
                                                                <label for="matrix_5_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_4" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="5" value="5">
                                                                <label for="matrix_5_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_5_q_5 matrix_5_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_5_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_5_4" id="matrix_5_4_5" data-matrix-id="matrix_5" data-matrix-label="Teamwork and Collaboration" data-matrix-question="Supports colleagues" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_5_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_9">Strengths</label>
                                            <textarea id="textarea_9" name="textarea_9" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_10">Areas of improvement</label>
                                            <textarea id="textarea_10" name="textarea_10" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_6" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_6" class="form-label">Problem-Solving and Initiative</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_6_0">Identifies problems proactively</label>
                                                        </th>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_0" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_6_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_1" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_6_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_2" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_6_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_3" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_6_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_4" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_6_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_1 matrix_6_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_6_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_0" id="matrix_6_0_5" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Identifies problems proactively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_6_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_6_1">Analyzes issues effectively</label>
                                                        </th>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_0" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="1" value="1">
                                                                <label for="matrix_6_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_1" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="2" value="2">
                                                                <label for="matrix_6_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_2" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="3" value="3">
                                                                <label for="matrix_6_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_3" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="4" value="4">
                                                                <label for="matrix_6_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_4" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="5" value="5">
                                                                <label for="matrix_6_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_2 matrix_6_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_6_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_1" id="matrix_6_1_5" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Analyzes issues effectively" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_6_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_6_2">Develops practical solutions</label>
                                                        </th>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_0" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="1" value="1">
                                                                <label for="matrix_6_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_1" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="2" value="2">
                                                                <label for="matrix_6_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_2" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="3" value="3">
                                                                <label for="matrix_6_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_3" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="4" value="4">
                                                                <label for="matrix_6_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_4" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="5" value="5">
                                                                <label for="matrix_6_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_3 matrix_6_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_6_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_2" id="matrix_6_2_5" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Develops practical solutions" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_6_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_6_3">Takes initiative appropriately</label>
                                                        </th>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_0" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="1" value="1">
                                                                <label for="matrix_6_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_1" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="2" value="2">
                                                                <label for="matrix_6_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_2" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="3" value="3">
                                                                <label for="matrix_6_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_3" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="4" value="4">
                                                                <label for="matrix_6_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_4" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="5" value="5">
                                                                <label for="matrix_6_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_4 matrix_6_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_6_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_3" id="matrix_6_3_5" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Takes initiative appropriately" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_6_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_6_4">Makes sound decisions</label>
                                                        </th>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_0" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="1" value="1">
                                                                <label for="matrix_6_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_1" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="2" value="2">
                                                                <label for="matrix_6_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_2" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="3" value="3">
                                                                <label for="matrix_6_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_3" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="4" value="4">
                                                                <label for="matrix_6_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_4" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="5" value="5">
                                                                <label for="matrix_6_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_6_q_5 matrix_6_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_6_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_6_4" id="matrix_6_4_5" data-matrix-id="matrix_6" data-matrix-label="Problem-Solving and Initiative" data-matrix-question="Makes sound decisions" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_6_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_11">Strengths</label>
                                            <textarea id="textarea_11" name="textarea_11" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_12">Areas of improvement</label>
                                            <textarea id="textarea_12" name="textarea_12" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_7" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_7" class="form-label">Professionalism and Work Ethic</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_7_0">Maintains confidentiality</label>
                                                        </th>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_0" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="1" value="1">
                                                                <label for="matrix_7_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_1" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="2" value="2">
                                                                <label for="matrix_7_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_2" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="3" value="3">
                                                                <label for="matrix_7_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_3" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="4" value="4">
                                                                <label for="matrix_7_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_4" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="5" value="5">
                                                                <label for="matrix_7_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_1 matrix_7_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_7_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_0" id="matrix_7_0_5" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Maintains confidentiality" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_7_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_7_1">Demonstrates reliability and punctuality</label>
                                                        </th>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_0" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="1" value="1">
                                                                <label for="matrix_7_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_1" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="2" value="2">
                                                                <label for="matrix_7_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_2" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="3" value="3">
                                                                <label for="matrix_7_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_3" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="4" value="4">
                                                                <label for="matrix_7_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_4" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="5" value="5">
                                                                <label for="matrix_7_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_2 matrix_7_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_7_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_1" id="matrix_7_1_5" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates reliability and punctuality" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_7_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_7_2">Accepts responsibility for actions</label>
                                                        </th>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_0" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="1" value="1">
                                                                <label for="matrix_7_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_1" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="2" value="2">
                                                                <label for="matrix_7_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_2" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="3" value="3">
                                                                <label for="matrix_7_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_3" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="4" value="4">
                                                                <label for="matrix_7_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_4" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="5" value="5">
                                                                <label for="matrix_7_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_3 matrix_7_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_7_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_2" id="matrix_7_2_5" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Accepts responsibility for actions" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_7_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_7_3">Demonstrates positive attitude</label>
                                                        </th>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_0" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="1" value="1">
                                                                <label for="matrix_7_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_1" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="2" value="2">
                                                                <label for="matrix_7_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_2" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="3" value="3">
                                                                <label for="matrix_7_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_3" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="4" value="4">
                                                                <label for="matrix_7_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_4" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="5" value="5">
                                                                <label for="matrix_7_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_7_q_4 matrix_7_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_7_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_7_3" id="matrix_7_3_5" data-matrix-id="matrix_7" data-matrix-label="Professionalism and Work Ethic" data-matrix-question="Demonstrates positive attitude" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_7_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_13">Strengths</label>
                                            <textarea id="textarea_13" name="textarea_13" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_14">Areas of improvement</label>
                                            <textarea id="textarea_14" name="textarea_14" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_8" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_8" class="form-label">Adaptability and Continuous Improvement</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                        <th class="text-center">NA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_8_0">Adapts to changing priorities</label>
                                                        </th>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_0" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="1" value="1">
                                                                <label for="matrix_8_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_1" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="2" value="2">
                                                                <label for="matrix_8_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_2" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="3" value="3">
                                                                <label for="matrix_8_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_3" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="4" value="4">
                                                                <label for="matrix_8_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_4" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="5" value="5">
                                                                <label for="matrix_8_0_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_1 matrix_8_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_8_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_0" id="matrix_8_0_5" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Adapts to changing priorities" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_8_0_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_8_1">Learns new skills willingly</label>
                                                        </th>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_0" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="1" value="1">
                                                                <label for="matrix_8_1_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_1" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="2" value="2">
                                                                <label for="matrix_8_1_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_2" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="3" value="3">
                                                                <label for="matrix_8_1_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_3" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="4" value="4">
                                                                <label for="matrix_8_1_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_4" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="5" value="5">
                                                                <label for="matrix_8_1_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_2 matrix_8_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_8_1"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_1" id="matrix_8_1_5" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Learns new skills willingly" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_8_1_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_8_2">Accepts and applies feedback</label>
                                                        </th>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_0" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="1" value="1">
                                                                <label for="matrix_8_2_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_1" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="2" value="2">
                                                                <label for="matrix_8_2_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_2" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="3" value="3">
                                                                <label for="matrix_8_2_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_3" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="4" value="4">
                                                                <label for="matrix_8_2_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_4" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="5" value="5">
                                                                <label for="matrix_8_2_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_3 matrix_8_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_8_2"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_2" id="matrix_8_2_5" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Accepts and applies feedback" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_8_2_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_8_3">Suggests process improvements</label>
                                                        </th>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_0" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="1" value="1">
                                                                <label for="matrix_8_3_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_1" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="2" value="2">
                                                                <label for="matrix_8_3_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_2" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="3" value="3">
                                                                <label for="matrix_8_3_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_3" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="4" value="4">
                                                                <label for="matrix_8_3_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_4" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="5" value="5">
                                                                <label for="matrix_8_3_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_4 matrix_8_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_8_3"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_3" id="matrix_8_3_5" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Suggests process improvements" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_8_3_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_8_4">Participates in professional development</label>
                                                        </th>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_0" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="1" value="1">
                                                                <label for="matrix_8_4_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_1" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="2" value="2">
                                                                <label for="matrix_8_4_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_2" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="3" value="3">
                                                                <label for="matrix_8_4_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_3" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="4" value="4">
                                                                <label for="matrix_8_4_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_4" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="5" value="5">
                                                                <label for="matrix_8_4_4"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_8_q_5 matrix_8_a_6" title="NA">
                                                            <div class="radio">
                                                                <span id="matrix_8_4"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_8_4" id="matrix_8_4_5" data-matrix-id="matrix_8" data-matrix-label="Adaptability and Continuous Improvement" data-matrix-question="Participates in professional development" data-matrix-answer="NA" value="NA">
                                                                <label for="matrix_8_4_5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_15">Strengths</label>
                                            <textarea id="textarea_15" name="textarea_15" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_16">Areas of improvement</label>
                                            <textarea id="textarea_16" name="textarea_16" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Page Break -->
                                    <div class="form-action col-xs-12"><button type="button" class="btn btn-default me-1 prev">Previous</button> <button type="button" class="btn btn-primary next">Next</button></div>
                                </fieldset>
                                <fieldset class="row">

                                    <!-- Matrix -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <table id="matrix_9" class="table-matrix table table-striped table-hover" data-matrix-type="radio">
                                                <caption>
                                                    <label for="matrix_9" class="form-label">Overall Performance Assessment</label>
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="text-center">1</th>
                                                        <th class="text-center">2</th>
                                                        <th class="text-center">3</th>
                                                        <th class="text-center">4</th>
                                                        <th class="text-center">5</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <label for="matrix_9_0">Overall Rating</label>
                                                        </th>
                                                        <td class="text-center matrix_9_q_1 matrix_9_a_1" title="1">
                                                            <div class="radio">
                                                                <span id="matrix_9_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_9_0" id="matrix_9_0_0" data-matrix-id="matrix_9" data-matrix-label="Overall Performance Assessment" data-matrix-question="Overall Rating" data-matrix-answer="1" value="1">
                                                                <label for="matrix_9_0_0"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_9_q_1 matrix_9_a_2" title="2">
                                                            <div class="radio">
                                                                <span id="matrix_9_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_9_0" id="matrix_9_0_1" data-matrix-id="matrix_9" data-matrix-label="Overall Performance Assessment" data-matrix-question="Overall Rating" data-matrix-answer="2" value="2">
                                                                <label for="matrix_9_0_1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_9_q_1 matrix_9_a_3" title="3">
                                                            <div class="radio">
                                                                <span id="matrix_9_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_9_0" id="matrix_9_0_2" data-matrix-id="matrix_9" data-matrix-label="Overall Performance Assessment" data-matrix-question="Overall Rating" data-matrix-answer="3" value="3">
                                                                <label for="matrix_9_0_2"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_9_q_1 matrix_9_a_4" title="4">
                                                            <div class="radio">
                                                                <span id="matrix_9_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_9_0" id="matrix_9_0_3" data-matrix-id="matrix_9" data-matrix-label="Overall Performance Assessment" data-matrix-question="Overall Rating" data-matrix-answer="4" value="4">
                                                                <label for="matrix_9_0_3"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center matrix_9_q_1 matrix_9_a_5" title="5">
                                                            <div class="radio">
                                                                <span id="matrix_9_0"></span>
                                                                <input class="form-check-input" type="radio" name="matrix_9_0" id="matrix_9_0_4" data-matrix-id="matrix_9" data-matrix-label="Overall Performance Assessment" data-matrix-question="Overall Rating" data-matrix-answer="5" value="5">
                                                                <label for="matrix_9_0_4"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_17">Additional feedback</label>
                                            <p class="form-text">For areas not covered above</p>
                                            <textarea id="textarea_17" name="textarea_17" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_18">Development Goals</label>
                                            <p class="form-text">For next period (for Self-Assessment)</p>
                                            <textarea id="textarea_18" name="textarea_18" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Text Area -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class=" form-label" for="textarea_19">Resources/Support Needed</label>
                                            <p class="form-text">For Self-Assessment</p>
                                            <textarea id="textarea_19" name="textarea_19" rows="3" data-alias="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <div class="col-12">
                                        <div style="height: 50px"></div>
                                    </div>

                                    <!-- Button -->
                                    <div class="col-12">
                                        <div class="form-action">
                                            <button type="button" class="btn btn-default me-1 prev">Previous</button> <button type="submit" id="button_1" name="button_1" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="" style="display:none"><label class="control-label" for="_email">Excuse me, but leave this field in blank</label><input type="text" id="_email" class="form-control" name="_email"></div>
                            </form>
                            <div id="progress" class="progress" style="display: none;">
                                <div id="bar" class="progress-bar" role="progressbar" style="width: 0;">
                                    <span id="percent" class="sr-only">0% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/libs/jquery.js"></script>
    <script src="js/libs/signature_pad.umd.js"></script>
    <script src="js/libs/jquery.form.js"></script>
    <script src="js/libs/jquery.easing.min.js"></script>
    <script src="js/form.utils.min.js"></script>
    <script src="js/form.resume.min.js"></script>
    <script src="js/libs/math.min.js"></script>
    <script src="js/form.evaluate.min.js"></script>
    <script src="js/libs/numeral.min.js"></script>
    <script src="js/libs/locales/numeral.min.js"></script>
    <script src="js/rules.engine.min.js"></script>
    <script src="js/rules.engine.run.min.js"></script>
    <script src="js/form.embed.min.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/flatpickr.date.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/flatpickr.class.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/intl-tel-input.tel.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/jquery.mask.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/jquery.ui.datepicker.date.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/jquery.ui.datepicker.class.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/krajee.file-input.class.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/krajee.star-rating.class.js"></script>
    <script src="//formapp.merqconsultancy.org/static_files/js/ui-widgets/select2.class.js"></script>
    <script>
        // Users mapping from PHP
        let users = <?php echo json_encode($users); ?>;
        let selectedUser = null;

        function updateEvaluatorFields() {
            let perspective = document.querySelector('input[name="radio_1"]:checked')?.value;

            if (!selectedUser && perspective !== "Other") return;

            // Get the parent .col-12 containers
            let evaluatorNameDiv = document.getElementById("text_2").closest(".col-12");
            let evaluatorEmailDiv = document.getElementById("email_1").closest(".col-12");

            if (perspective === "Other") {
                evaluatorNameDiv.style.display = "none";
                evaluatorEmailDiv.style.display = "none";
            } else {
                evaluatorNameDiv.style.display = "block";
                evaluatorEmailDiv.style.display = "block";
            }

            // Fill evaluator fields
            if (perspective === "Supervisor" && selectedUser?.supervisor_id) {
                let supervisor = users.find(u => u.user_id == selectedUser.supervisor_id);
                if (supervisor) {
                    document.getElementById("text_2").value = supervisor.full_name || "";
                    document.getElementById("email_1").value = supervisor.email || "";
                } else {
                    document.getElementById("text_2").value = "Supervisor not found";
                    document.getElementById("email_1").value = "";
                }
            } else {
                if (selectedUser) {
                    document.getElementById("text_2").value = selectedUser.full_name || "";
                    document.getElementById("email_1").value = selectedUser.email || "";
                }
            }

            // === Update the display section ===
            const empDisplay = document.getElementById("employee-display");
            const perspectiveDisplay = document.getElementById("perspective-display");
            const supervisorDetails = document.getElementById("supervisor-details");

            // Employee display
            empDisplay.innerHTML = selectedUser ?
                "<strong>Employee:</strong> " + selectedUser.full_name :
                "";

            // Perspective display
            perspectiveDisplay.innerHTML = perspective ?
                "<strong>Perspective:</strong> " + perspective :
                "";

            // Supervisor details
            if (perspective === "Supervisor" && selectedUser?.supervisor_id) {
                let supervisor = users.find(u => u.user_id == selectedUser.supervisor_id);
                if (supervisor) {
                    supervisorDetails.style.display = "block";
                    supervisorDetails.innerHTML =
                        "<strong>Supervisor:</strong> " + supervisor.full_name +
                        " <br><strong>Email:</strong> " + (supervisor.email || "N/A");
                } else {
                    supervisorDetails.style.display = "block";
                    supervisorDetails.innerHTML = "<strong>Supervisor:</strong> Not found";
                }
            } else {
                supervisorDetails.style.display = "none";
                supervisorDetails.innerHTML = "";
            }

        }

        // Handle employee select change
        document.getElementById("selectlist_1").addEventListener("change", function() {
            let userId = this.value;
            selectedUser = users.find(u => u.user_id == userId);

            if (selectedUser) {
                if (document.getElementById("selectlist_2"))
                    document.getElementById("selectlist_2").value = selectedUser.position_title || "";
                if (document.getElementById("department"))
                    document.getElementById("department").value = selectedUser.department_name || "";
            }

            updateEvaluatorFields();
        });

        // Handle perspective change
        document.querySelectorAll('input[name="radio_1"]').forEach(radio => {
            radio.addEventListener("change", updateEvaluatorFields);
        });

        // Auto-fill today's date
        document.addEventListener("DOMContentLoaded", function() {
            let dateInput = document.getElementById("date_1");
            if (dateInput && !dateInput.value) {
                let today = new Date();
                let yyyy = today.getFullYear();
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let dd = String(today.getDate()).padStart(2, '0');
                dateInput.value = `${yyyy}-${mm}-${dd}`;
            }
        });
    </script>
</body>

</html>