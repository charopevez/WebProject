<div class='column'>
    <div class='search'>
        <div class='search_bar'>
            <form action="{{route('search')}}" method="post">
                @csrf
                <input id='searchOne' type='checkbox'>
                <label for='searchOne'>
                    <i class='fa fa-search'></i>
                    <i class='last icon fa fa-times'></i>
                    <p>|</p>
                </label>
                <input class="search-bar" type="text" name="search" autocomplete="off" placeholder="Search Keyword" id="autocomplete">
            </form>
            <div id="itemname"></div>
        </div>
    </div>
</div>
