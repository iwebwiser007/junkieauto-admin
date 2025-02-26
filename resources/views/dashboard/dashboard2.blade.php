<x-header></x-header>
<x-nav></x-nav>


<div class="page-body dashboard-2-main">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>$ {{number_format($new_earning,2)}}</h5>
                    <p>Our Annual Income (New)</p>
                    
                    </div>
                </div>
            </div>

            <div class="col-lg-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>$ {{number_format($junk_earning,2)}}</h5>
                    <p>Our Annual Income (Junk)</p>
                    
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>$ {{number_format($used_earning,2)}}</h5>
                    <p>Our Annual Income (Used)</p>
                    
                    </div>
                </div>
            </div>

            <div class="col-lg-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>$ {{number_format($total_annual_earn,2)}}</h5>
                    <p>Our Annual Income</p>
                    
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-3 des-xl-25 rate-sec">
                <a href="{{url('seller_req')}}">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>{{$seller_req}}</h5>
                    <p>Seller Requests</p>
                    
                    </div>
                </div>
                </a>
            </div>
            
            
            
            <div class="col-lg-3 des-xl-25 rate-sec">
                <a href="{{url('document_req')}}">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>{{$document_req}}</h5>
                    <p>Document Requests</p>
                    
                    </div>
                </div>
                </a>
            </div>
            
            <div class="col-lg-3 des-xl-25 rate-sec">
                <a href="{{url('request_auction')}}">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>{{$auc_req}}</h5>
                    <p>Auction Requests</p>
                    
                    </div>
                </div>
                </a>
            </div>
            
            <div class="col-lg-3 des-xl-25 rate-sec">
                <a href="{{url('deals')}}">
                <div class="card income-card card-primary">                                 
                    <div class="card-body text-center">                                  
                    
                    <h5>{{$deals}}</h5>
                    <p>Annual Deals</p>
                    
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        <div class="row">

            <!-- Seller Chart -->
            <div class="col-xl-6 box-col-12 des-xl-100 invoice-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Seller Chart </h5>
                            <div class="center-content">
                                <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i> {{ ($seller_result > 0) ?  number_format($seller_result,2) : '0' }}% More Than Last Month
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        
                        <canvas id="sellerChart" style="width:600px;height:120px;padding:10px;"></canvas>
                        
                    </div>
                </div>
            </div>

            <!-- Auction Chart -->
            <div class="col-xl-6 box-col-12 des-xl-100 invoice-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Auction Chart </h5>
                            <div class="center-content">
                                <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i> {{ ($auction_result > 0) ?  number_format($seller_result,2) : '0' }}% More Than Last Month
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        
                        <canvas id="auctionChart" style="width:600px;height:120px;padding:10px;"></canvas>
                        
                    </div>
                </div>
            </div>

            <!-- Bids Chart -->
            <div class="col-xl-6 box-col-12 des-xl-100 invoice-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Bids Chart </h5>
                            <div class="center-content">
                                <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i> {{ ($bids_result > 0) ?  number_format($bids_result,2) : '0' }}% More Than Last Month
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        
                        <canvas id="bidsChart" style="width:600px;height:120px;padding:10px;"></canvas>
                        
                    </div>
                </div>
            </div>
            
            <!-- Earning Chart -->
            <div class="col-xl-6 box-col-12 des-xl-100 invoice-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Earning Overview </h5>
                            <div class="center-content">
                                <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i> {{ ($earn_result > 0) ?  number_format($earn_result,2) : '0' }}% More Than Last Month
                                </p>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- <div id="timeline-chart"></div> -->
                        <canvas id="myChart" style="width:600px;height:120px;padding:10px;"></canvas>
                       
                    </div>
                </div>
            </div>

            


            

            



            <!-- Top Seller -->
            <div class="col-xl-12 box-col-12 des-xl-100 top-dealer-sec">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Top Sellers</h5>
                            <!--<div class="center-content">-->
                            <!--    <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>{{ ($seller_result > 0) ?  number_format($seller_result,2) : '0' }}% More Than Last Month-->
                            <!--    </p>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="card-body">
                       
                        <div class="item">
                            <div class="row">
                                    
                                    @forelse($top_seller as $top)
                                    
                                        <div class="col-2">
                                            <div class="item">
                                                <div class="card">
                                                    
                                                    <div class="top-dealerbox text-center">
                                                        <h6>{{$top->user->first_name}} {{$top->user->last_name}} </h6>
                                                        <p>{{$top->user->country}}</p><a class="btn btn-rounded"
                                                            href="{{url('seller_detail/'.$top->user->id)}}">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @empty
                                    @endforelse
                                      
                                    
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Top Dealer -->
            <div class="col-xl-12 box-col-12 des-xl-100 top-dealer-sec">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Top Dealer</h5>
                            <!--<div class="center-content">-->
                            <!--    <i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>{{ ($seller_result > 0) ?  number_format($seller_result,2) : '0' }}% More Than Last Month-->
                            <!--    </p>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="card-body">
                       
                        <div class="item">
                            <div class="row">
                                    
                                    @forelse($top_dealer as $top)
                                    
                                        <div class="col-2">
                                            <div class="item">
                                                <div class="card">
                                                    
                                                    <div class="top-dealerbox text-center">
                                                        <h6>{{$top->users->first_name}} {{$top->users->last_name}} </h6>
                                                        <p>{{$top->users->country}}</p><a class="btn btn-rounded"
                                                            href="{{url('dealer_detail/'.$top->users->id)}}">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @empty
                                    @endforelse
                                      
                                    
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>



<x-footer></x-footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    var userData = <?php echo json_encode($userData)?>;

    new Chart("myChart", {
        type: "line",
        data: {
        labels: ['Jan','Feb','March','April','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{ 
            data: [{{rtrim($userData,',')}}],
            borderColor: "rgb(36, 105, 92)",
            fill: false
        }]
        },
        options: {
        legend: {
            display: false,
            
            position: 'bottom',
            legendText: "Oranges",
            labels: {
            fontColor: "#000080",
            
            }
        },
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: true,
                
            }
            }]
        }
        }
    });
</script>

<!-- Seller Chart -->
<script>
    var sellerData = <?php echo json_encode($sellerData)?>;

    new Chart("sellerChart", {
        type: "line",
        data: {
        labels: ['Jan','Feb','March','April','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{ 
            data: [{{rtrim($sellerData,',')}}],
            borderColor: "rgb(36, 105, 92)",
            fill: false
        }]
        },
        options: {
        legend: {
            display: false,
            
            position: 'bottom',
            legendText: "Oranges",
            labels: {
            fontColor: "#000080",
            
            }
        },
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: true,
                
            }
            }]
        }
        }
    });
</script>

<!-- Auction Chart -->
<script>
    var auctionData = <?php echo json_encode($auctionData)?>;

    new Chart("auctionChart", {
        type: "line",
        data: {
        labels: ['Jan','Feb','March','April','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{ 
            data: [{{rtrim($auctionData,',')}}],
            borderColor: "rgb(36, 105, 92)",
            fill: false
        }]
        },
        options: {
        legend: {
            display: false,
            
            position: 'bottom',
            legendText: "Oranges",
            labels: {
            fontColor: "#000080",
            
            }
        },
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: true,
                
            }
            }]
        }
        }
    });
</script>

<!-- Bids Chart -->
<script>
    var bidsData = <?php echo json_encode($bidsData)?>;

    new Chart("bidsChart", {
        type: "line",
        data: {
        labels: ['Jan','Feb','March','April','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{ 
            data: [{{rtrim($bidsData,',')}}],
            borderColor: "rgb(36, 105, 92)",
            fill: false
        }]
        },
        options: {
        legend: {
            display: false,
            
            position: 'bottom',
            legendText: "Oranges",
            labels: {
            fontColor: "#000080",
            
            }
        },
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: true,
                
            }
            }]
        }
        }
    });
</script>