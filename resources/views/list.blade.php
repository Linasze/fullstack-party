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

        <div class="row no-gutters">
            <div class="col-sm gray">
                <div class="text-center mt-4">
                    <a class="logout mr-4" href="#"><img class="mr-2" src="{{ asset('/images/open.png') }}" alt="open">{{$total_open}} Open</a>
                    <a class="closed" href="#"><img class="mr-2" src="{{ asset('/images/closed.png') }}" alt="closed">{{ number_format($total_close) }} Closed</a>
                </div>

                <div class="overflow">
                    @foreach($issues as $issue)
                    <div class="box">
                        <div class="row">
                            <div class="col-sm-10"> <img class="mr-2" src="{{ asset('/images/exclamation-mark.png') }}"
                                    alt="exclamation-mark">
                                <a href="entry?issue={{ $issue['number']}}">{{ $issue['title']}}</a></div>
                            <div class="col-sm-2"><img class="mr-1 " src="{{ asset('/images/comments.png') }}" alt="comments"><a href="entry?issue={{ $issue['number']}}">{{ $issue['comments']}}</a></div>
                        </div>
                        <div class="small-text ml-4 mt-2">#{{ $issue['number'] }} opened {{ Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }} by <a class="small-text-link" href="#">{{ $issue['user']['login'] }}</a></div>
                    </div>
                    @endforeach
                </div>
                <nav>
                    <ul class="page">
                        <li class="page-item">
                            <a class="small-text-link {{ (isset($_GET['page']) ? (isset($_GET['page']) && $_GET['page'] <= 1 ? 'isDisabled' : '') : 'isDisabled')}}"
                                href="?page={{ (isset($_GET['page']) ? ($_GET['page'] > 1 ? $_GET['page']-1 : $_GET['page']) : '1')}}">Previous</a>
                        </li>
                        @for($page=1; $page <= $total_open/$per_page; $page++) 
                        <li><a class="page-i {{ (isset($_GET['page']) && $_GET['page'] == $page ? 'active' : '') }}" href="?page={{ $page }}"> {{ $page }} </a></li>
                        @endfor
                            <li class="page-item"><a class="small-text-link  {{(isset($_GET['page']) && $_GET['page'] == round(Session::get('count')['total_count']/$per_page-1) ? 'isDisabled' : '')}}" href="?page={{ (isset($_GET['page']) ? ($_GET['page'] > 1 ? $_GET['page']+1 : $_GET['page']) : '2') }}">Next</a></li>
                    </ul>
                </nav>

            </div>

            <div class="col-sm">
                <div class="left-background center-items">
                    <div class="task">Back End Developer Task</div>
                    <div class="by">by <img class="ml-1" src="{{ asset('/images/small-logo2.png') }}" alt="logo"></div>
                </div>
            </div>
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
