@foreach($mochaList as $mocha)
    <div>
        Id -> {{$mocha['id']}}
    </div>
    <div>
        Title -> {{$mocha['title']}}
    </div>
    <div>
        Location -> {{$mocha['location']}}
    </div>
    <br/>
@endforeach