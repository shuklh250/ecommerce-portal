<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        @stack('title')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{url('dashboard/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>


    <style>
        /* Flash message css style */
        .alert {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        /* Fade out effect */
        .fade-out {
            opacity: 0;
        }
    </style>
    {{-- flash message script --}}
<script>
    // JavaScript to fade out message after 3 seconds
    window.onload = function() {
        let flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(function() {
                flashMessage.classList.add('fade-out');
            }, 3000); // 3 seconds delay
        }
    };
</script>