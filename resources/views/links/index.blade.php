<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
   
    
    <div class="container" >
        <h1>Create Link</h1>
        <form method="post" class="form-inline">
            @csrf
            <div class="form-group mx-sm-4 mb-4">
                <label for="url" class="sr-only">URL:</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="URL">
                @error('url')
                <span style="color: red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-2">Generate Link</button>
        </form>
    </div>

    <div class="container" >
    <h1>Links</h1>

    <table class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col"> URL</th>
            <th scope="col">No of Clicks</th>
            <th scope="col">Copy Link</th>
        </tr>
        @foreach ($links as $link)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td id="url_string">{{ $link->url }}</td>
            <td>{{ $link->clicks }}</td>
            <td> <button id="copyBtn" onclick="copyToClipboard('{{$link->code }}', {{ $loop->iteration }})">Copy Shareable Link</button>
            <span id="ptext{{ $loop->iteration }}"></span></td>
        </tr>
        @endforeach
    </table>
</div>
    <script>
        function copyToClipboard(text, serial_no) {
            const input = document.createElement('input');
            input.value = "{{url('/')}}"+"/"+text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            var paragraph = document.getElementById('ptext'+serial_no);
            paragraph.textContent = "Link copied!";
           
        }

    </script>
</body>
</html>