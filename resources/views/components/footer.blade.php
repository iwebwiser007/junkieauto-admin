<!---- Logout Modal ---->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Logout</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <!--<form action="{{url('logout')}}" method="post" id="add_make_name">-->
                  @csrf
                    <p>Are you sure to logout ?</p>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <a href="{{url('logout')}}"><button class="btn btn-primary" type="button" >Logout</button></a>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  
    </div>
    <!------- page-wrapper End ------->
</div>
<!------- Main Container End ------->
 
 
 <!---- Jquery v3.5.1  ---->
  <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"></script>

  <!---- Bootstrap js ---->
  <script src=" {{asset('js/bootstrap/popper.min.js')}} "></script>
  <script src="{{asset('js/bootstrap/bootstrap.min.js')}} "></script>

  <!---- Fontawesome 5.15.4 js ---->
    <script src="{{asset('js/fontawsome.js')}}"></script>

  <!---- Sidebar jquery ---->
  <script src="{{asset('js/sidebar-menu.js')}}"></script>
  <script src="{{asset('js/config.js')}}"></script>

  <!---- Theme js ---->
   <!---- Theme js ---->
  <script src="{{asset('js/script.js')}}"></script>


   <!------- Datatable 1.10.16 js start ------->
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
   
    <script src="{{asset('js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('js/tooltip-init.js')}}"></script>
    <!------- Datatable js End ------->

    {{-- dahboard extra --}}
    <script src="{{asset('js/extra/chart.min.js')}}"></script>
    <script src="{{asset('js/extra/chartist.js')}}"></script>
    <script src="{{asset('js/extra/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('js/extra/knob.min.js')}}"></script>
    <script src="{{asset('js/extra/apex-chart.js')}}"></script>
    <script src="{{asset('js/extra/stock-prices.js')}}"></script>
    <script src="{{asset('js/extra/prism.min.js')}}"></script>
    <script src="{{asset('js/extra/clipboard.min.js')}}"></script>
    <script src="{{asset('js/extra/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/extra/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/extra/counter-custom.js')}}"></script>
    <script src="{{asset('js/extra/custom-card.js')}}"></script>
    <script src="{{asset('js/extra/owl.carousel.js')}}"></script>
    <script src="{{asset('js/extra/owl-custom.js')}}"></script>
    <script src="{{asset('js/extra/dashboard_2.js')}}"></script>
    <script src="{{asset('js/admin.js?t=356356356')}}"></script>
    <script src="{{asset('bundels/izitoast/js/iziToast.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css"></script>


</body>
</html>