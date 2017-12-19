<div class="dashboard-paginate-container">
    <div>
        @if ($page > 0 && $number > 20)
            <a href="/dashboard/?page={{$page - 1}}">previous</a>
        @elseif ($number > 20)
            previous
        @endif
    </div>
    <div>{{ ($page * 20 + 1) }} to {{ ((($page * 20) + 20) > $number) ? $number : (($page == 0) ? 20 : (($page * 20) + 20)) }} of {{ $number }} session{{ ($number == 1) ? '' : 's'}}</div>
    <div>
        @if (($page * 20) > ($number - 20) && $number > 20)
            next
        @elseif ($number > 20)
            <a href="/dashboard/?page={{ $page + 1 }}">next</a>
        @endif
    </div>
</div>