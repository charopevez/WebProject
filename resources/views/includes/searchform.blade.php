
         
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
              <form action="{{route('search')}}" method="post" class="d-md-flex justify-content-between">
                    @csrf
                    <input type="text" name="search" placeholder="{{$data['search'] ?? " "}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'" required>
                      <select name = "orderBy">
                        <option value = "0">Sort by</option>
                        <option value = "1">価格が安い順</option>
                        <option value = "2">価格が高い順</option>
                      </select>

                      <select name = "option">
                          <option value="All" name = "" selected>Website</option>
                          <option value="Amazon">Amazon</option>
                          <option value="Rakuten">Rakuten</option>
                          <option value="Yahoo">Yahoo</option>
                      </select>
                      
                      <button type="submit" class="template-btn">find banana</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Search Area End -->