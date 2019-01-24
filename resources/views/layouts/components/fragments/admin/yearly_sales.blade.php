<div class="card">
        <div class="card-header">
            Monthly Sales
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <form action="./yearly_sales_data" method="get">
                        <select class="form-control" name="input_year" id="input_year" placeholder="Input year">
                                <option value="{{$thisYear}}">{{$thisYear}}</option>
            
                                @php
                                for($thisYear = 2018; $thisYear <= 2101; $thisYear++) {
                                    echo '<option value="'.$thisYear++.'">'.$thisYear++.'</option>';
                                }
                                @endphp
                        </select>
                            <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm mt-2">Generate</button>
                        </div>
                    </form>
                </div>
                <div class="col-8">
                    <div class="h5">
                        Yearly Sales: ₱<span id="today-sales">{{$yearlySales}}</span><hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@include('layouts.components.fragments.admin.sales_javascript')