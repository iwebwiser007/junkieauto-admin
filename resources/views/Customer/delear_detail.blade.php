<x-header></x-header>
<x-nav></x-nav>


  <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Seller Details</h5>
                  </div>
                  <div class="card-body">
                    <div class="user-profile">
                      <div class="row align-items-center">
                        <!-- user profile header start-->
                        <div class="col-sm-12">
                          <div class="card profile-header p-0 flex-row justify-content-between row">
                            <div class="col-12">
                              <div class="userpro-box w-100">
                                <div
                                  class="user-designation text-start user-designation text-start d-flex justify-content-between">
                                  <div class="title">
                                    <h4 class="mb-1">Emay Walter</h4>
                                    <h6>(south africa)</h6>
                                    <a href="mailto:admin@gmail.com" class="mb-2 d-inline-block"><i
                                        class="fas fa-at"></i>
                                      customer123@gmail.com</a>

                                    <a class="mb-2 d-block" href="tel:+4733378901"><i
                                        class="fas fa-phone-square-alt"></i>
                                      1234567890</a>

                                    <a href="#" class="mb-0 mt-2"><i class="fas fa-map-marked-alt"></i> 2136 Kamp
                                      St,Milnerton,<br>Western Cape
                                    </a>
                                    <p class="badge rounded-pill bg-warning text-dark mt-2 d-block w-50 f-14 r">PayPal
                                    </p>
                                  </div>

                                  <div class="follow mt-3">
                                    <ul class="follow-list">
                                      <li>
                                        <div class="follow-num counter text-center">450</div><span>Active Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">500</div><span>Sold Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">50</div><span>Cancelled
                                          Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">20</div><span>request Auction</span>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-xl-12 xl-100">
                          {{-- <h5>Customer Bids </h5> --}}

                          <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home"
                                role="tab" aria-controls="info-home" aria-selected="true">All Auction</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="profile-info-tab" data-bs-toggle="tab" href="#info-profile"
                                role="tab" aria-controls="info-profile" aria-selected="false">Active Auction</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" id="contact-info-tab" data-bs-toggle="tab"
                                href="#info-contact" role="tab" aria-controls="info-contact" aria-selected="false">Sold
                                Auction</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" id="contact-info-tab" data-bs-toggle="tab"
                                href="#info-contact-1" role="tab" aria-controls="info-contact"
                                aria-selected="false">Cancelled
                                Auction
                              </a>
                            </li>

                            <li class="nav-item"><a class="nav-link" id="contact-info-tab" data-bs-toggle="tab"
                                href="#info-contact-2" role="tab" aria-controls="info-contact"
                                aria-selected="false">request Auction</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" id="contact-info-tab" data-bs-toggle="tab"
                                href="#info-contact-3" role="tab" aria-controls="info-contact" aria-selected="false">Bid
                                List</a>
                            </li>
                          </ul>

                          <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-home" role="tabpanel"
                              aria-labelledby="info-home-tab">
                              <!-- Container-fluid starts-->
                              <div class="container-fluid p-0">
                                <div class="row">
                                  <!-- Default ordering (sorting) Starts-->
                                  <div class="col-sm-12">
                                    <div class="card border-0">
                                      <div class="card-body p-1">
                                        <div class="table-responsive">
                                          <table class="display dataTable" id="basic-3">
                                            <thead>
                                              <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                              </tr>
                                              <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                              </tr>
                                              <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                              </tr>
                                              <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                              </tr>
                                              <tr>
                                                <td>Airi Satou</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>33</td>
                                                <td>2008/11/28</td>
                                                <td>$162,700</td>
                                              </tr>
                                              <tr>
                                                <td>Brielle Williamson</td>
                                                <td>Integration Specialist</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2012/12/02</td>
                                                <td>$372,000</td>
                                              </tr>
                                              <tr>
                                                <td>Herrod Chandler</td>
                                                <td>Sales Assistant</td>
                                                <td>San Francisco</td>
                                                <td>59</td>
                                                <td>2012/08/06</td>
                                                <td>$137,500</td>
                                              </tr>
                                              <tr>
                                                <td>Rhona Davidson</td>
                                                <td>Integration Specialist</td>
                                                <td>Tokyo</td>
                                                <td>55</td>
                                                <td>2010/10/14</td>
                                                <td>$327,900</td>
                                              </tr>
                                              <tr>
                                                <td>Colleen Hurst</td>
                                                <td>Javascript Developer</td>
                                                <td>San Francisco</td>
                                                <td>39</td>
                                                <td>2009/09/15</td>
                                                <td>$205,500</td>
                                              </tr>
                                              <tr>
                                                <td>Sonya Frost</td>
                                                <td>Software Engineer</td>
                                                <td>Edinburgh</td>
                                                <td>23</td>
                                                <td>2008/12/13</td>
                                                <td>$103,600</td>
                                              </tr>
                                              <tr>
                                                <td>Jena Gaines</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>30</td>
                                                <td>2008/12/19</td>
                                                <td>$90,560</td>
                                              </tr>
                                              <tr>
                                                <td>Quinn Flynn</td>
                                                <td>Support Lead</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2013/03/03</td>
                                                <td>$342,000</td>
                                              </tr>
                                              <tr>
                                                <td>Charde Marshall</td>
                                                <td>Regional Director</td>
                                                <td>San Francisco</td>
                                                <td>36</td>
                                                <td>2008/10/16</td>
                                                <td>$470,600</td>
                                              </tr>
                                              <tr>
                                                <td>Haley Kennedy</td>
                                                <td>Senior Marketing Designer</td>
                                                <td>London</td>
                                                <td>43</td>
                                                <td>2012/12/18</td>
                                                <td>$313,500</td>
                                              </tr>
                                              <tr>
                                                <td>Tatyana Fitzpatrick</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>19</td>
                                                <td>2010/03/17</td>
                                                <td>$385,750</td>
                                              </tr>
                                              <tr>
                                                <td>Michael Silva</td>
                                                <td>Marketing Designer</td>
                                                <td>London</td>
                                                <td>66</td>
                                                <td>2012/11/27</td>
                                                <td>$198,500</td>
                                              </tr>
                                              <tr>
                                                <td>Paul Byrd</td>
                                                <td>Chief Financial Officer (CFO)</td>
                                                <td>New York</td>
                                                <td>64</td>
                                                <td>2010/06/09</td>
                                                <td>$725,000</td>
                                              </tr>
                                              <tr>
                                                <td>Gloria Little</td>
                                                <td>Systems Administrator</td>
                                                <td>New York</td>
                                                <td>59</td>
                                                <td>2009/04/10</td>
                                                <td>$237,500</td>
                                              </tr>
                                              <tr>
                                                <td>Bradley Greer</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>41</td>
                                                <td>2012/10/13</td>
                                                <td>$132,000</td>
                                              </tr>
                                              <tr>
                                                <td>Dai Rios</td>
                                                <td>Personnel Lead</td>
                                                <td>Edinburgh</td>
                                                <td>35</td>
                                                <td>2012/09/26</td>
                                                <td>$217,500</td>
                                              </tr>
                                              <tr>
                                                <td>Jenette Caldwell</td>
                                                <td>Development Lead</td>
                                                <td>New York</td>
                                                <td>30</td>
                                                <td>2011/09/03</td>
                                                <td>$345,000</td>
                                              </tr>
                                              <tr>
                                                <td>Yuri Berry</td>
                                                <td>Chief Marketing Officer (CMO)</td>
                                                <td>New York</td>
                                                <td>40</td>
                                                <td>2009/06/25</td>
                                                <td>$675,000</td>
                                              </tr>
                                              <tr>
                                                <td>Caesar Vance</td>
                                                <td>Pre-Sales Support</td>
                                                <td>New York</td>
                                                <td>21</td>
                                                <td>2011/12/12</td>
                                                <td>$106,450</td>
                                              </tr>
                                              <tr>
                                                <td>Doris Wilder</td>
                                                <td>Sales Assistant</td>
                                                <td>Sidney</td>
                                                <td>23</td>
                                                <td>2010/09/20</td>
                                                <td>$85,600</td>
                                              </tr>
                                              <tr>
                                                <td>Angelica Ramos</td>
                                                <td>Chief Executive Officer (CEO)</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2009/10/09</td>
                                                <td>$1,200,000</td>
                                              </tr>
                                              <tr>
                                                <td>Gavin Joyce</td>
                                                <td>Developer</td>
                                                <td>Edinburgh</td>
                                                <td>42</td>
                                                <td>2010/12/22</td>
                                                <td>$92,575</td>
                                              </tr>
                                              <tr>
                                                <td>Jennifer Chang</td>
                                                <td>Regional Director</td>
                                                <td>Singapore</td>
                                                <td>28</td>
                                                <td>2010/11/14</td>
                                                <td>$357,650</td>
                                              </tr>
                                              <tr>
                                                <td>Brenden Wagner</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>28</td>
                                                <td>2011/06/07</td>
                                                <td>$206,850</td>
                                              </tr>
                                              <tr>
                                                <td>Fiona Green</td>
                                                <td>Chief Operating Officer (COO)</td>
                                                <td>San Francisco</td>
                                                <td>48</td>
                                                <td>2010/03/11</td>
                                                <td>$850,000</td>
                                              </tr>
                                              <tr>
                                                <td>Shou Itou</td>
                                                <td>Regional Marketing</td>
                                                <td>Tokyo</td>
                                                <td>20</td>
                                                <td>2011/08/14</td>
                                                <td>$163,000</td>
                                              </tr>
                                              <tr>
                                                <td>Michelle House</td>
                                                <td>Integration Specialist</td>
                                                <td>Sidney</td>
                                                <td>37</td>
                                                <td>2011/06/02</td>
                                                <td>$95,400</td>
                                              </tr>
                                              <tr>
                                                <td>Suki Burks</td>
                                                <td>Developer</td>
                                                <td>London</td>
                                                <td>53</td>
                                                <td>2009/10/22</td>
                                                <td>$114,500</td>
                                              </tr>
                                              <tr>
                                                <td>Prescott Bartlett</td>
                                                <td>Technical Author</td>
                                                <td>London</td>
                                                <td>27</td>
                                                <td>2011/05/07</td>
                                                <td>$145,000</td>
                                              </tr>
                                              <tr>
                                                <td>Gavin Cortez</td>
                                                <td>Team Leader</td>
                                                <td>San Francisco</td>
                                                <td>22</td>
                                                <td>2008/10/26</td>
                                                <td>$235,500</td>
                                              </tr>
                                              <tr>
                                                <td>Martena Mccray</td>
                                                <td>Post-Sales support</td>
                                                <td>Edinburgh</td>
                                                <td>46</td>
                                                <td>2011/03/09</td>
                                                <td>$324,050</td>
                                              </tr>
                                              <tr>
                                                <td>Unity Butler</td>
                                                <td>Marketing Designer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/12/09</td>
                                                <td>$85,675</td>
                                              </tr>
                                              <tr>
                                                <td>Howard Hatfield</td>
                                                <td>Office Manager</td>
                                                <td>San Francisco</td>
                                                <td>51</td>
                                                <td>2008/12/16</td>
                                                <td>$164,500</td>
                                              </tr>
                                              <tr>
                                                <td>Hope Fuentes</td>
                                                <td>Secretary</td>
                                                <td>San Francisco</td>
                                                <td>41</td>
                                                <td>2010/02/12</td>
                                                <td>$109,850</td>
                                              </tr>
                                              <tr>
                                                <td>Vivian Harrell</td>
                                                <td>Financial Controller</td>
                                                <td>San Francisco</td>
                                                <td>62</td>
                                                <td>2009/02/14</td>
                                                <td>$452,500</td>
                                              </tr>
                                              <tr>
                                                <td>Timothy Mooney</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>37</td>
                                                <td>2008/12/11</td>
                                                <td>$136,200</td>
                                              </tr>
                                              <tr>
                                                <td>Jackson Bradshaw</td>
                                                <td>Director</td>
                                                <td>New York</td>
                                                <td>65</td>
                                                <td>2008/09/26</td>
                                                <td>$645,750</td>
                                              </tr>
                                              <tr>
                                                <td>Olivia Liang</td>
                                                <td>Support Engineer</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2011/02/03</td>
                                                <td>$234,500</td>
                                              </tr>
                                              <tr>
                                                <td>Bruno Nash</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>38</td>
                                                <td>2011/05/03</td>
                                                <td>$163,500</td>
                                              </tr>
                                              <tr>
                                                <td>Sakura Yamamoto</td>
                                                <td>Support Engineer</td>
                                                <td>Tokyo</td>
                                                <td>37</td>
                                                <td>2009/08/19</td>
                                                <td>$139,575</td>
                                              </tr>
                                              <tr>
                                                <td>Thor Walton</td>
                                                <td>Developer</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2013/08/11</td>
                                                <td>$98,540</td>
                                              </tr>
                                              <tr>
                                                <td>Finn Camacho</td>
                                                <td>Support Engineer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/07/07</td>
                                                <td>$87,500</td>
                                              </tr>
                                              <tr>
                                                <td>Serge Baldwin</td>
                                                <td>Data Coordinator</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2012/04/09</td>
                                                <td>$138,575</td>
                                              </tr>
                                              <tr>
                                                <td>Zenaida Frank</td>
                                                <td>Software Engineer</td>
                                                <td>New York</td>
                                                <td>63</td>
                                                <td>2010/01/04</td>
                                                <td>$125,250</td>
                                              </tr>
                                              <tr>
                                                <td>Zorita Serrano</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>56</td>
                                                <td>2012/06/01</td>
                                                <td>$115,000</td>
                                              </tr>
                                              <tr>
                                                <td>Jennifer Acosta</td>
                                                <td>Junior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>43</td>
                                                <td>2013/02/01</td>
                                                <td>$75,650</td>
                                              </tr>
                                              <tr>
                                                <td>Cara Stevens</td>
                                                <td>Sales Assistant</td>
                                                <td>New York</td>
                                                <td>46</td>
                                                <td>2011/12/06</td>
                                                <td>$145,600</td>
                                              </tr>
                                              <tr>
                                                <td>Hermione Butler</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2011/03/21</td>
                                                <td>$356,250</td>
                                              </tr>
                                              <tr>
                                                <td>Lael Greer</td>
                                                <td>Systems Administrator</td>
                                                <td>London</td>
                                                <td>21</td>
                                                <td>2009/02/27</td>
                                                <td>$103,500</td>
                                              </tr>
                                              <tr>
                                                <td>Jonas Alexander</td>
                                                <td>Developer</td>
                                                <td>San Francisco</td>
                                                <td>30</td>
                                                <td>2010/07/14</td>
                                                <td>$86,500</td>
                                              </tr>
                                              <tr>
                                                <td>Shad Decker</td>
                                                <td>Regional Director</td>
                                                <td>Edinburgh</td>
                                                <td>51</td>
                                                <td>2008/11/13</td>
                                                <td>$183,000</td>
                                              </tr>
                                              <tr>
                                                <td>Michael Bruce</td>
                                                <td>Javascript Developer</td>
                                                <td>Singapore</td>
                                                <td>29</td>
                                                <td>2011/06/27</td>
                                                <td>$183,000</td>
                                              </tr>
                                              <tr>
                                                <td>Donna Snider</td>
                                                <td>Customer Support</td>
                                                <td>New York</td>
                                                <td>27</td>
                                                <td>2011/01/25</td>
                                                <td>$112,000</td>
                                              </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                              </tr>
                                            </tfoot>
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

                            <div class="tab-pane fade" id="info-profile" role="tabpanel"
                              aria-labelledby="profile-info-tab">
                              <p>Banana</p>
                            </div>

                            <div class="tab-pane fade" id="info-contact" role="tabpanel"
                              aria-labelledby="contact-info-tab">
                              <p>Cat</p>
                            </div>

                            <div class="tab-pane fade" id="info-contact-1" role="tabpanel"
                              aria-labelledby="contact-info-tab">
                              <p>Dog</p>
                            </div>

                            <div class="tab-pane fade" id="info-contact-2" role="tabpanel"
                              aria-labelledby="contact-info-tab">
                              <p>Elephant</p>
                            </div>

                            <div class="tab-pane fade" id="info-contact-3" role="tabpanel"
                              aria-labelledby="contact-info-tab">
                              <p>Fan</p>
                            </div>
                          </div>
                        </div>
                        <!-- user profile header end-->
                      </div>
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