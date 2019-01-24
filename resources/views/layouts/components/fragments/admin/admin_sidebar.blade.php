<div class="card" style="width: 20rem;">
        <div class="card-body text-center">
          <h4 class="card-title">Welcome</h4>
          <p class="card-text">{{Auth::user()->name}}</p>
        </div>
        <div class="card-header text-center">
            <span class="h3 lead">Products</span>
        </div>
        <ul class="list-group list-group-flush">
          <a href="./create_product"><li class="nav-link list-group-item">Product List</li></a>
          <a href="./create_category"><li class="nav-link list-group-item">Create Category</li></a>
        </ul>
        <div class="card-header text-center">
                <span class="h3 lead">Analytics</span>
            </div>
            <ul class="list-group list-group-flush">
              <a href="./daily_sales"><li class="nav-link list-group-item">Daily Sales</li></a>
              <a href="./monthly_sales"><li class="nav-link list-group-item">Monthly Sales</li></a>
              <a href="./yearly_sales"><li class="nav-link list-group-item">Yearly Sales</li></a>
            </ul>
        <div class="card-footer">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="nav-link">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
      </div>