<div class="card">
    <div class="card-header">
        Monthly Sales
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="col-12">
                    <form action="./monthly_sales_data" method="get">
                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="month" id="month">
                            <option selected>Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <button class="btn btn-success btn-sm mt-2" type="submit">Generate</button>
                    </form>      
                </div>
            </div>
            <div class="col-8">
                <div class="h5">
                    
                    Monthly Sales: ₱<span id="today-sales">{{$monthlySales}}</span><hr>
                    
                </div>
            </div>
        </div>
    </div>
</div>

        @include('layouts.components.fragments.admin.sales_javascript')