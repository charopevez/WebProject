<div class='search-block'>
    <div class='search_bar'>
        <form action="{{route('search')}}" method="post">
            @csrf
            <input id='searchOne' type='checkbox'>
            <label for='searchOne'>
                <i class='fa fa-search'></i>
                <i class='last icon fa fa-times'></i>
                <p>|</p>
            </label>
            <input class="search-bar" type="text" name="search" autocomplete="off" placeholder="Search Keyword">
        </form>
    </div>
    <div id="search-suggestion"></div>
</div>
