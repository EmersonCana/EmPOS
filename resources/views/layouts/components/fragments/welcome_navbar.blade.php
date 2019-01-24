<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">EmPOS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    
      <li class="dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
              Orders <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            @foreach($getOrder as $orders)
              <li class="dropdown-item">
                  {{-- <a class="nav-link lead" id="order_{{$orders->transaction_id}}">{{$getTransaction->find($orders->transaction_id)->order_by}}</a> --}}
              </li>
              @include('layouts.components.fragments.orders_dropdown_javascript')
            @endforeach
          </ul>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>

        <li class="nav-item">
          <span class="nav-link">Transaction ID: <span id="transaction_id"></span></span>
        </li>
    </ul>
  </div>
</nav>
