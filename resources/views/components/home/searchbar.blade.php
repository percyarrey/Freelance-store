@props(['category'])

  <section class="px-3 container-lg">
    <div class="input-group">
      <select style="height: 37.3px !important" onchange="handleCategory()" id='selectcategory' class="form-select rounded-start" aria-label="Category">
        <option value="n">All Category</option>
        @foreach ($category as $cat)
        <option value="{{$cat->category}}" {{ $cat->category == request('category') ? 'selected' : '' }}>{{$cat->category}}</option>
        @endforeach
      </select>
      <input type="search" name="search" id="searchInput" class="form-control rounded-none w-50 w-lg-" placeholder="Search" aria-label="Search" aria-describedby="search-addon" value="{{request('search')}}">
      <button onclick="appendSearchParam()" style="height: 37.3px !important" type="submit" class="btn btn-outline-success">
        <span><i class="fa fa-search d-sm-none"></i></span>
        <span class="d-none d-sm-block">Search</span>
      </button>
    </div>
  </section>
