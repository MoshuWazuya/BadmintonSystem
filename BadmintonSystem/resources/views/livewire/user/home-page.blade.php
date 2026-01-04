<div>
    <h1>Badminton Court Booking System</h1>
    <p>Check real-time court availability below</p>

    @foreach($courts as $court)
        <div style="background:#fff;padding:10px;margin:10px;border-radius:5px">
            <strong>Court {{ $court->court_number }}</strong><br>

            @if($court->status == 'available')
                <span style="color:green">Available</span>
            @elseif($court->status == 'maintenance')
                <span style="color:orange">Maintenance</span>
            @else
                <span style="color:red">Booked</span>
            @endif
        </div>
    @endforeach
</div>
