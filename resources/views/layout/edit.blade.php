
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit entry</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container p-5">
        
        {{-- {{$entry->trade_code}}
        {{$entry->high}}
        {{$entry->low}}
        {{$entry->open}} --}}
        <div class="card shadow p-5" style="width: 60%; margin:auto;">
            <h3 class="text-center mb-2">Edit Entry #{{$entry->id}}</h3>
            <form action="{{ route('confirm', $entry->id) }}" method="post">
                @csrf
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="date" value="{{ Carbon\Carbon::parse($entry->date)->isoFormat('MMM D, Y')}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Trade_code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="trade_code" value="{{$entry->trade_code}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">High</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="high" value="{{$entry->high}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Low</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="low" value="{{$entry->low}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Open</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="open" value="{{$entry->open}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Close</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="close" value="{{$entry->close}}">         
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Volume</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-2" name="volume" value="{{$entry->volume}}">
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="button" class="btn btn-secondary btn-sm mr-2"><a class="text-light text-decoration-none" href="/">Cancel</a></button>
                    <button type="submit" class="btn btn-sm btn-success">Save Changes</button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
