<form action="{{route('search')}}" method="post">
    <div class='search_block'>
        <div class='search_bar'>
            @csrf
            <input type='checkbox' id="search_btn">
            <label for='search_btn'>
                <i class='fa fa-search'></i>
                <i class='last icon fa fa-times'></i>
                <p>|</p>
            </label>
            <input type="text" name="search" autocomplete="off" placeholder="Search Keyword" id="search_input">
        </div>
         <div class="search_settings">
             <input class="search_option" type='checkbox' id="search_amazon">
             <label for='search_amazon'>Amazon</label>
             <input class="search_option" type='checkbox' id="search_rakuten">
             <label for='search_rakuten'>Rakuten</label>
             <input class="search_option" type='checkbox' id="search_yahoo">
             <label for='search_yahoo'>Yahoo</label>
         </div>
         <div class="search_suggestion"></div>
    </div>
</form>
