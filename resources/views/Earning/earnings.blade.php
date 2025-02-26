<x-header></x-header>
<x-nav></x-nav>


    <div class="page-body">
      
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Earnings</h5>
                                <strong class="my-2"> Total Earning</strong>
                                <div class="badge badge-primary">$ {{number_format($earn,2) ?? '0'}} </div>
                            </div>

                            <div class="filter">
                            <div class="{{($headname == 'Auctionwise')? '' : 'd-none'}}" id="dateshow">
                                    <form action="{{url('earnings')}}" method="post" id="datewise" class="d-flex">
                                        @csrf
                                        
                                        <input class="form-control" type="date" name="date1" id="date1" value="{{$date1}}">
                                        <input class="form-control mx-3" type="date" name="date2" id="date2" value="{{$date2}}">
                                        <button class="btn btn-primary" type="button" onclick="dateValid()">Submit</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="action-buttons">
                                <form action="{{url('earnings')}}" method="post" id='used_type'>
                              @csrf
                              <select class="form-select" id="auc_type" name="auc_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Used Type"></option>
                                <option value="All" {{($headname == 'All')? 'selected' : ''}}>All</option>
                                <option value ='Auctionwise' {{($headname == 'Auctionwise')? 'selected' : ''}}>Auctionwise</option>
                                <!--<option value="New" {{($headname == 'New')? 'selected' : ''}}>New</option>-->
                                <!--<option value="Used" {{($headname == 'Used')? 'selected' : ''}} >Used</option>-->
                                <!--<option value="Junk" {{($headname == 'Junk')? 'selected' : ''}} >Junk</option>-->
                                @forelse($used_type as $used)
                                <option value="{{$used->id}}" {{($headname == $used->id)? 'selected' : ''}}>{{$used->name}}</option>
                                @empty
                                @endforelse
                                
                              </select>
                            </form>

                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Used Type</th>
                                            <th >Bid Amount (in $)</th>
                                            <th>Commission(in $)</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($earning as $earn)
                                        @isset($earn->auction->uses)
                                        <tr>
                                            
                                            <td>{{$earn->users->first_name ?? ''}} {{$earn->users->last_name ?? ''}}</td>
                                            <td>{{$earn->auction->makes->name ?? ''}}</td>
                                            <td>{{$earn->auction->models->name ?? ''}}</td>
                                            <td>{{$earn->auction->uses->name ?? ''}}</td>
                                            <td align='center'>{{$earn->bid_amount ?? ''}}</td>
                                            <td align='center'>{{$earn->commission_amount ?? ''}}</td>
                                            <td align='center'>
                                                <a href="{{url('auction_detail/'.$earn->auction_id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @endisset
                                        @empty
                                        <tr>
                                            <td colspan='7' align='center'>No data available</td>
                                        </tr>
                                        @endforelse
                                      
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Default ordering (sorting) Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

 

<x-footer></x-footer>

<script>
  function select(id){
        if(id == 'Auctionwise'){
            $('#dateshow').removeClass('d-none');    
        }else{
        $('#used_type').submit();
        }
    }
    function dateValid(){
        var date1 = $('#date1').val();
        var date2 = $('#date2').val();
        
        if($('#date1').val() == ''){
            iziToast.warning({
                message: 'Please choose a date',
                position: 'topCenter'
            });
            return ;
        }else if($('#date2').val() == ''){
            iziToast.warning({
                message: 'Please choose a date',
                position: 'topCenter'
            });
            return ;
        }else if(date1>date2){
            iziToast.warning({
                message: 'Date selection is wrong',
                position: 'topCenter'
            });
            return ;
        }else{
            $('#datewise').submit();
        }
    }
</script>
