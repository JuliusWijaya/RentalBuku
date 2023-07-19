<div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>NO</th>
                <th>USERNAME</th>
                <th>TITLE BOOK</th>
                <th>RENT DATE</th>
                <th>RETURN DATE</th>
                <th>ACTUAL RETURN DATE</th>
                <th>STATUS</th>
            </tr>
        </thead>
        @if ($rentlog->count())
        <tbody>
            @foreach ($rentlog as $key => $rent)
            <tr
              class="{{ $rent->actual_return_date == null ? '' :
               ($rent->return_date < $rent->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                <td>{{ ($rentlog->currentpage()-1) * $rentlog->perpage() + $key + 1 }}</td>
                <td>{{ $rent->user->username }}</td>
                <td>{{ $rent->book->title }}</td>
                <td>{{ $rent->rent_date }}</td>
                <td>{{ $rent->return_date }}</td>
                <td>{{ $rent->actual_return_date }}</td>
                <td>{{ $rent->book->status }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="text-center text-danger fw-semibold">Rent Logs Not Found</td>
            </tr>
        </tbody>
        @endif
    </table>

    <div>
        {{ $rentlog->links() }}
    </div>
</div>