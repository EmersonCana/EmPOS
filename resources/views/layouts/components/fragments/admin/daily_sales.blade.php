<div class="card">
    <div class="card-header">
        Daily Sales
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <input id="datepicker" width="276" placeholder="Select Date"/>
            </div>
            <div class="col-8">
                <div class="h5">
                    Today Sales: ₱<span id="today-sales">{{$dailySales}}</span><hr>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        Sales Report
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">Customer Name/Table</th>
                <th scope="col">Count</th>
                <th scope="col">Price</th>
                <th scope="col">When</th>
                </tr>
            </thead>
            <tbody id="daily_sales_data">
                @foreach($getDailySales->unique('order_name') as $sales)
                
                <tr>
                    <th scope="row">{{$sales->order_name}}</th>
                    <td>{{$getSalesCount->where('order_name','=',$sales->order_name)->count()}}</td>
                    <td>₱{{$getSalesPrice->where('order_name','=',$sales->order_name)->sum('price')}}</td>
                    <td>{{$sales->updated_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('layouts.components.fragments.admin.sales_javascript')