

    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
      <div class="header-top">
         <div class="container">
            <div class="row">
               <div class="col-lg-10">
                     <div class="main-menu main-menu-light">
                     </div>
               </div>
            </div>
         </div>
      </div>

<!-- Search Area Starts -->
<div class="search-area">
  <div class="search-bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
              <form action="{{route('search')}}" method="get" class="d-md-flex justify-content-between">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="search" placeholder="{{$data['search'] ?? " "}}" onfocus="this.placeholder = ''" value = "{{request()->search}}" required>
                      <select name = "orderBy">
                        <option value = "0">Sort by</option>
                        <option value = "1" {{request()->orderBy == 1 ? 'selected' : '' }}>価格が安い順</option>
                        <option value = "2" {{request()->orderBy == 2 ? 'selected' : '' }}>価格が高い順</option>
                      </select>

                      <select name = "option">
                          <option value="All" name = "" selected>Website</option>
                          <option value="Amazon" {{request()->option == 'Amazon' ? 'selected' : '' }}>Amazon</option>
                          <option value="Rakuten" {{request()->option == 'Rakuten' ? 'selected' : '' }}>Rakuten</option>
                          <option value="Yahoo" {{request()->option == 'Yahoo' ? 'selected' : '' }}>Yahoo</option>
                      </select>

                      <button type="submit" class="template-btn">find banana</button>
                  </form>
              </div>
              <div id="search_option">
                  <input type="checkbox" id="option0" name="option0" value="All" class="img-checkbox">
                  <label for="option0" class="img-checkbox-label"><img alt="all" src="{{asset('/img/logos/logo-all.png')}}" class="img-logo"></label>
                  <input type="checkbox" id="option1" name="option1" value="Amazon" class="img-checkbox">
                  <label for="option1" class="img-checkbox-label"><img alt="Amazon" src="{{asset('/img/logos/logo-amazon.png')}}" class="img-logo"></label>
                  <input type="checkbox" id="option2" name="option2" value="Rakuten" class="img-checkbox">
                  <label for="option2" class="img-checkbox-label"> <img alt="Rakuten" src="{{asset('/img/logos/logo-rakuten.png')}}" class="img-logo"></label>
                  <input type="checkbox" id="option3" name="option3" value="Yahoo" class="img-checkbox">
                  <label for="option3" class="img-checkbox-label"><img alt="Yahoo" src="{{asset('/img/logos/logo-yahoo.png')}}" class="img-logo"></label>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Search Area End -->
