<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>List</title>
</head>
<body>

    @if (!empty(Session::get('auth')))
    <div class="container">
        <div class="d-flex flex-column flex-sm-row align-items-end p-3 px-md-4 bg-white border-bottom ">
            <div class="my-0 mr-md-auto mb-3"><a href="/list"><img src="{{ asset('/images/small-logo.png') }}" alt="logo"></a></div>

            <a class="logout mb-4" href="logout"><img class="mr-2" src="{{ asset('/images/logout.png') }}" alt="logout">Logout</a>
        </div>
        <div class="back-issues gray"><a class="small-text-link" href="/list"><img src="{{ asset('/images/back.png') }}">
                Back to issues</a></div>
        <div class="row d-flex justify-content-center gray no-gutters">

            <div class="box2">
                <div class="col-sm">
                    <span class="title">{{ $issue['title'] }}</span><span class="ml-2 number">#{{ $issue['number'] }}</span>
                </div>
                <div class="col-sm"><span class="state"><img src="{{ asset('/images/exclamation-mark-white.png') }}"
                            alt=""> {{ $issue['state'] }} </span>&nbsp; &nbsp;
                    <a class="small-text-link" href="{{ $issue['url'] }}">{{ $issue['user']['login']}}</a> <span class="small-text">opened
                        this issue {{ Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }} {{
                        $issue['comments'] }} comment</span>

                </div>
            </div>

            <table>
                <tr>
                    <td><img src="{{ $issue['user']['avatar_url'] }}" alt="avatar" style="border-radius: 50%; height: 50px;"><img
                            class="ml-2" src="{{ asset('/images/arrow.png') }}" alt="arrow"></td>
                    <td class="box3"><a class="small-text-link" href="#">{{ $issue['user']['login']}}</a> <span class="small-text">commented
                            {{ Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }}</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="box3 body">{{ $issue['body'] }}</td>
                </tr>
            </table>

            @foreach($comments as $comment)
            <table class="mt-5">
                <tr>
                    <td><img src="{{ $comment['user']['avatar_url'] }}" alt="avatar" style="border-radius: 50%; height: 50px;"><img
                            class="ml-2" src="{{ asset('/images/arrow.png') }}" alt="arrow"></td>
                    <td class="box3"><a class="small-text-link" href="#">{{ $comment['user']['login']}}</a> <span class="small-text">commented
                            {{ Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="box3 body">{{ $comment['body'] }}</td>
                </tr>
            </table>
            @endforeach
        </div>


        <div class="pb-5 gray"></div>
    </div>
    </div>

    @else
    <script>
        window.location = "/";

    </script>
    @endif
    </div>
</body>

</html>
