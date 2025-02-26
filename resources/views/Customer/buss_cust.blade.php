<x-header></x-header>
<x-nav></x-nav>


    <div class="page-body">
      
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          <h5>All Sellers</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile no.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($seller as $sel)
                                        <tr>
                                            <td>{{$sel->first_name }}</td>
                                            <td>{{$sel->email}}</td>
                                            <td>{{$sel->mobile_number}}</td>
                                           
                                            <td>
                                                <a href="{{url('dealer_detail/'.$sel->id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @empty
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