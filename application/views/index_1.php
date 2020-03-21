
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Artgoobi || Home</title>
        <link rel="shortcut icon" type="image/x-icon" href="http://localhost/artgoobi/images/icon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="http://localhost/artgoobi/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://localhost/artgoobi/js/global_url.js"></script>
        <link href="http://localhost/artgoobi/css/artgoobi.css" rel="stylesheet">
        <!---------------------- LightBox --------------------------- -->
        <link href="http://localhost/artgoobi/lightbox/css/lightbox.min.css" rel="stylesheet">
        <script src="http://localhost/artgoobi/lightbox/js/lightbox-plus-jquery.min.js"></script>
        <script src="http://localhost/artgoobi/js/jquery-3.2.1.min.js"></script>
        <script src="http://localhost/artgoobi/js/bootstrap.min.js"></script>
        <script src="http://localhost/artgoobi/js/signup.js"></script>
        <script src="http://localhost/artgoobi/js/frontside.js"></script>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2 header_logo">
                            <a href="http://localhost/artgoobi/"><img src="http://localhost/artgoobi/logo.png" height="105"/></a>
                        </div>
                        <div class="col-md-8 pull-right" style="margin-top: 3%">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Journal</a></li>
                                        <li><a href="#">Sell</a></li>
                                    </ul>
                                    <form class="navbar-form navbar-right">
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control"  placeholder="Search" >
                                            <span class="input-group-addon">
                                                <button type="submit">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>  
                                            </span>
                                        </div>
                                    </form>                                        
                                </div>
                            </nav>
                            <div class="box after_custom_search_box">
                                <div class="box-body">
                                    <div class="row">
                                                                                <div id="logged_in_area" class="col-md-12 pull-right" style="margin-right: -11px; text-align: right;">
                                            <a href="http://localhost/artgoobi/welcome/user_profile">
                                                <img src="http://localhost/artgoobi/images/default_avater.png" class="user-image" alt="User Image" width="25">
                                                <span class="hidden-xs">
                                                    Rizvee Qureshee                                                </span>
                                            </a>
                                        </div> 
                                                                                <div class="col-md-2 pull-right">
                                                                                        <a id="logout_link" href="#" class="btn btn-default btn-flat btn-xs profile_link_style" data-toggle="modal" data-target="#modal_user_logout">LOGOUT</a>
                                                                                    </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- USER LOGGED IN MODAL ----->
                    <div class="modal fade" id="modal_userloggin">
                        <div class="modal-dialog">
                            <form action="" id="userlogin" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Login</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger alert-dismissible" id="op_alert_sec" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                            <span id="op_message"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            <span class="help-block"></span>
                                        </div>                                      
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-primary">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="user_login_process();">Login</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </form>
                            <!-- /Form-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
                    <!-- SIGNUP MODAL ----->
                    <div class="modal fade" id="modal_signup">
                        <div class="modal-dialog">
                            <form action="" id="signup" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Signup</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="signup_type" value="6" checked>Artist
                                                </label>
                                                <label>
                                                    <input type="radio" name="signup_type" value="7">Visitor
                                                </label>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender" value="1" checked>Male
                                                </label>
                                                <label>
                                                    <input type="radio" name="gender" value="2">Female
                                                </label>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                                            <span class="help-block"></span>
                                        </div>
                                        <!-- Country Drop Down -->
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country" class="form-control">
                                                <option value="">Please Select</option>
                                                                                                <option value="1">AFGHANISTAN</option>
                                                                                                    <option value="2">ALBANIA</option>
                                                                                                    <option value="3">ALGERIA</option>
                                                                                                    <option value="4">AMERICAN SAMOA</option>
                                                                                                    <option value="5">ANDORRA</option>
                                                                                                    <option value="6">ANGOLA</option>
                                                                                                    <option value="7">ANGUILLA</option>
                                                                                                    <option value="8">ANTARCTICA</option>
                                                                                                    <option value="9">ANTIGUA AND BARBUDA</option>
                                                                                                    <option value="10">ARGENTINA</option>
                                                                                                    <option value="11">ARMENIA</option>
                                                                                                    <option value="12">ARUBA</option>
                                                                                                    <option value="13">AUSTRALIA</option>
                                                                                                    <option value="14">AUSTRIA</option>
                                                                                                    <option value="15">AZERBAIJAN</option>
                                                                                                    <option value="16">BAHAMAS</option>
                                                                                                    <option value="17">BAHRAIN</option>
                                                                                                    <option value="18">BANGLADESH</option>
                                                                                                    <option value="19">BARBADOS</option>
                                                                                                    <option value="20">BELARUS</option>
                                                                                                    <option value="21">BELGIUM</option>
                                                                                                    <option value="22">BELIZE</option>
                                                                                                    <option value="23">BENIN</option>
                                                                                                    <option value="24">BERMUDA</option>
                                                                                                    <option value="25">BHUTAN</option>
                                                                                                    <option value="26">BOLIVIA</option>
                                                                                                    <option value="27">BOSNIA AND HERZEGOVINA</option>
                                                                                                    <option value="28">BOTSWANA</option>
                                                                                                    <option value="29">BOUVET ISLAND</option>
                                                                                                    <option value="30">BRAZIL</option>
                                                                                                    <option value="31">BRITISH INDIAN OCEAN TERRITORY</option>
                                                                                                    <option value="32">BRUNEI DARUSSALAM</option>
                                                                                                    <option value="33">BULGARIA</option>
                                                                                                    <option value="34">BURKINA FASO</option>
                                                                                                    <option value="35">BURUNDI</option>
                                                                                                    <option value="36">CAMBODIA</option>
                                                                                                    <option value="37">CAMEROON</option>
                                                                                                    <option value="38">CANADA</option>
                                                                                                    <option value="39">CAPE VERDE</option>
                                                                                                    <option value="40">CAYMAN ISLANDS</option>
                                                                                                    <option value="41">CENTRAL AFRICAN REPUBLIC</option>
                                                                                                    <option value="42">CHAD</option>
                                                                                                    <option value="43">CHILE</option>
                                                                                                    <option value="44">CHINA</option>
                                                                                                    <option value="45">CHRISTMAS ISLAND</option>
                                                                                                    <option value="46">COCOS (KEELING) ISLANDS</option>
                                                                                                    <option value="47">COLOMBIA</option>
                                                                                                    <option value="48">COMOROS</option>
                                                                                                    <option value="49">CONGO</option>
                                                                                                    <option value="50">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                                                                                                    <option value="51">COOK ISLANDS</option>
                                                                                                    <option value="52">COSTA RICA</option>
                                                                                                    <option value="53">COTE D'IVOIRE</option>
                                                                                                    <option value="54">CROATIA</option>
                                                                                                    <option value="55">CUBA</option>
                                                                                                    <option value="56">CYPRUS</option>
                                                                                                    <option value="57">CZECH REPUBLIC</option>
                                                                                                    <option value="58">DENMARK</option>
                                                                                                    <option value="59">DJIBOUTI</option>
                                                                                                    <option value="60">DOMINICA</option>
                                                                                                    <option value="61">DOMINICAN REPUBLIC</option>
                                                                                                    <option value="62">ECUADOR</option>
                                                                                                    <option value="63">EGYPT</option>
                                                                                                    <option value="64">EL SALVADOR</option>
                                                                                                    <option value="65">EQUATORIAL GUINEA</option>
                                                                                                    <option value="66">ERITREA</option>
                                                                                                    <option value="67">ESTONIA</option>
                                                                                                    <option value="68">ETHIOPIA</option>
                                                                                                    <option value="69">FALKLAND ISLANDS (MALVINAS)</option>
                                                                                                    <option value="70">FAROE ISLANDS</option>
                                                                                                    <option value="71">FIJI</option>
                                                                                                    <option value="72">FINLAND</option>
                                                                                                    <option value="73">FRANCE</option>
                                                                                                    <option value="74">FRENCH GUIANA</option>
                                                                                                    <option value="75">FRENCH POLYNESIA</option>
                                                                                                    <option value="76">FRENCH SOUTHERN TERRITORIES</option>
                                                                                                    <option value="77">GABON</option>
                                                                                                    <option value="78">GAMBIA</option>
                                                                                                    <option value="79">GEORGIA</option>
                                                                                                    <option value="80">GERMANY</option>
                                                                                                    <option value="81">GHANA</option>
                                                                                                    <option value="82">GIBRALTAR</option>
                                                                                                    <option value="83">GREECE</option>
                                                                                                    <option value="84">GREENLAND</option>
                                                                                                    <option value="85">GRENADA</option>
                                                                                                    <option value="86">GUADELOUPE</option>
                                                                                                    <option value="87">GUAM</option>
                                                                                                    <option value="88">GUATEMALA</option>
                                                                                                    <option value="89">GUINEA</option>
                                                                                                    <option value="90">GUINEA-BISSAU</option>
                                                                                                    <option value="91">GUYANA</option>
                                                                                                    <option value="92">HAITI</option>
                                                                                                    <option value="93">HEARD ISLAND AND MCDONALD ISLANDS</option>
                                                                                                    <option value="94">HOLY SEE (VATICAN CITY STATE)</option>
                                                                                                    <option value="95">HONDURAS</option>
                                                                                                    <option value="96">HONG KONG</option>
                                                                                                    <option value="97">HUNGARY</option>
                                                                                                    <option value="98">ICELAND</option>
                                                                                                    <option value="99">INDIA</option>
                                                                                                    <option value="100">INDONESIA</option>
                                                                                                    <option value="101">IRAN, ISLAMIC REPUBLIC OF</option>
                                                                                                    <option value="102">IRAQ</option>
                                                                                                    <option value="103">IRELAND</option>
                                                                                                    <option value="104">ISRAEL</option>
                                                                                                    <option value="105">ITALY</option>
                                                                                                    <option value="106">JAMAICA</option>
                                                                                                    <option value="107">JAPAN</option>
                                                                                                    <option value="108">JORDAN</option>
                                                                                                    <option value="109">KAZAKHSTAN</option>
                                                                                                    <option value="110">KENYA</option>
                                                                                                    <option value="111">KIRIBATI</option>
                                                                                                    <option value="112">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                                                                                                    <option value="113">KOREA, REPUBLIC OF</option>
                                                                                                    <option value="114">KUWAIT</option>
                                                                                                    <option value="115">KYRGYZSTAN</option>
                                                                                                    <option value="116">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                                                                                                    <option value="117">LATVIA</option>
                                                                                                    <option value="118">LEBANON</option>
                                                                                                    <option value="119">LESOTHO</option>
                                                                                                    <option value="120">LIBERIA</option>
                                                                                                    <option value="121">LIBYAN ARAB JAMAHIRIYA</option>
                                                                                                    <option value="122">LIECHTENSTEIN</option>
                                                                                                    <option value="123">LITHUANIA</option>
                                                                                                    <option value="124">LUXEMBOURG</option>
                                                                                                    <option value="125">MACAO</option>
                                                                                                    <option value="126">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
                                                                                                    <option value="127">MADAGASCAR</option>
                                                                                                    <option value="128">MALAWI</option>
                                                                                                    <option value="129">MALAYSIA</option>
                                                                                                    <option value="130">MALDIVES</option>
                                                                                                    <option value="131">MALI</option>
                                                                                                    <option value="132">MALTA</option>
                                                                                                    <option value="133">MARSHALL ISLANDS</option>
                                                                                                    <option value="134">MARTINIQUE</option>
                                                                                                    <option value="135">MAURITANIA</option>
                                                                                                    <option value="136">MAURITIUS</option>
                                                                                                    <option value="137">MAYOTTE</option>
                                                                                                    <option value="138">MEXICO</option>
                                                                                                    <option value="139">MICRONESIA, FEDERATED STATES OF</option>
                                                                                                    <option value="140">MOLDOVA, REPUBLIC OF</option>
                                                                                                    <option value="141">MONACO</option>
                                                                                                    <option value="142">MONGOLIA</option>
                                                                                                    <option value="143">MONTSERRAT</option>
                                                                                                    <option value="144">MOROCCO</option>
                                                                                                    <option value="145">MOZAMBIQUE</option>
                                                                                                    <option value="146">MYANMAR</option>
                                                                                                    <option value="147">NAMIBIA</option>
                                                                                                    <option value="148">NAURU</option>
                                                                                                    <option value="149">NEPAL</option>
                                                                                                    <option value="150">NETHERLANDS</option>
                                                                                                    <option value="151">NETHERLANDS ANTILLES</option>
                                                                                                    <option value="152">NEW CALEDONIA</option>
                                                                                                    <option value="153">NEW ZEALAND</option>
                                                                                                    <option value="154">NICARAGUA</option>
                                                                                                    <option value="155">NIGER</option>
                                                                                                    <option value="156">NIGERIA</option>
                                                                                                    <option value="157">NIUE</option>
                                                                                                    <option value="158">NORFOLK ISLAND</option>
                                                                                                    <option value="159">NORTHERN MARIANA ISLANDS</option>
                                                                                                    <option value="160">NORWAY</option>
                                                                                                    <option value="161">OMAN</option>
                                                                                                    <option value="162">PAKISTAN</option>
                                                                                                    <option value="163">PALAU</option>
                                                                                                    <option value="164">PALESTINIAN TERRITORY, OCCUPIED</option>
                                                                                                    <option value="165">PANAMA</option>
                                                                                                    <option value="166">PAPUA NEW GUINEA</option>
                                                                                                    <option value="167">PARAGUAY</option>
                                                                                                    <option value="168">PERU</option>
                                                                                                    <option value="169">PHILIPPINES</option>
                                                                                                    <option value="170">PITCAIRN</option>
                                                                                                    <option value="171">POLAND</option>
                                                                                                    <option value="172">PORTUGAL</option>
                                                                                                    <option value="173">PUERTO RICO</option>
                                                                                                    <option value="174">QATAR</option>
                                                                                                    <option value="175">REUNION</option>
                                                                                                    <option value="176">ROMANIA</option>
                                                                                                    <option value="177">RUSSIAN FEDERATION</option>
                                                                                                    <option value="178">RWANDA</option>
                                                                                                    <option value="179">SAINT HELENA</option>
                                                                                                    <option value="180">SAINT KITTS AND NEVIS</option>
                                                                                                    <option value="181">SAINT LUCIA</option>
                                                                                                    <option value="182">SAINT PIERRE AND MIQUELON</option>
                                                                                                    <option value="183">SAINT VINCENT AND THE GRENADINES</option>
                                                                                                    <option value="184">SAMOA</option>
                                                                                                    <option value="185">SAN MARINO</option>
                                                                                                    <option value="186">SAO TOME AND PRINCIPE</option>
                                                                                                    <option value="187">SAUDI ARABIA</option>
                                                                                                    <option value="188">SENEGAL</option>
                                                                                                    <option value="189">SERBIA AND MONTENEGRO</option>
                                                                                                    <option value="190">SEYCHELLES</option>
                                                                                                    <option value="191">SIERRA LEONE</option>
                                                                                                    <option value="192">SINGAPORE</option>
                                                                                                    <option value="193">SLOVAKIA</option>
                                                                                                    <option value="194">SLOVENIA</option>
                                                                                                    <option value="195">SOLOMON ISLANDS</option>
                                                                                                    <option value="196">SOMALIA</option>
                                                                                                    <option value="197">SOUTH AFRICA</option>
                                                                                                    <option value="198">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                                                                                                    <option value="199">SPAIN</option>
                                                                                                    <option value="200">SRI LANKA</option>
                                                                                                    <option value="201">SUDAN</option>
                                                                                                    <option value="202">SURINAME</option>
                                                                                                    <option value="203">SVALBARD AND JAN MAYEN</option>
                                                                                                    <option value="204">SWAZILAND</option>
                                                                                                    <option value="205">SWEDEN</option>
                                                                                                    <option value="206">SWITZERLAND</option>
                                                                                                    <option value="207">SYRIAN ARAB REPUBLIC</option>
                                                                                                    <option value="208">TAIWAN, PROVINCE OF CHINA</option>
                                                                                                    <option value="209">TAJIKISTAN</option>
                                                                                                    <option value="210">TANZANIA, UNITED REPUBLIC OF</option>
                                                                                                    <option value="211">THAILAND</option>
                                                                                                    <option value="212">TIMOR-LESTE</option>
                                                                                                    <option value="213">TOGO</option>
                                                                                                    <option value="214">TOKELAU</option>
                                                                                                    <option value="215">TONGA</option>
                                                                                                    <option value="216">TRINIDAD AND TOBAGO</option>
                                                                                                    <option value="217">TUNISIA</option>
                                                                                                    <option value="218">TURKEY</option>
                                                                                                    <option value="219">TURKMENISTAN</option>
                                                                                                    <option value="220">TURKS AND CAICOS ISLANDS</option>
                                                                                                    <option value="221">TUVALU</option>
                                                                                                    <option value="222">UGANDA</option>
                                                                                                    <option value="223">UKRAINE</option>
                                                                                                    <option value="224">UNITED ARAB EMIRATES</option>
                                                                                                    <option value="225">UNITED KINGDOM</option>
                                                                                                    <option value="226">UNITED STATES</option>
                                                                                                    <option value="227">UNITED STATES MINOR OUTLYING ISLANDS</option>
                                                                                                    <option value="228">URUGUAY</option>
                                                                                                    <option value="229">UZBEKISTAN</option>
                                                                                                    <option value="230">VANUATU</option>
                                                                                                    <option value="231">VENEZUELA</option>
                                                                                                    <option value="232">VIET NAM</option>
                                                                                                    <option value="233">VIRGIN ISLANDS, BRITISH</option>
                                                                                                    <option value="234">VIRGIN ISLANDS, U.S.</option>
                                                                                                    <option value="235">WALLIS AND FUTUNA</option>
                                                                                                    <option value="236">WESTERN SAHARA</option>
                                                                                                    <option value="237">YEMEN</option>
                                                                                                    <option value="238">ZAMBIA</option>
                                                                                                    <option value="239">ZIMBABWE</option>
                                                                                                </select>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code">
                                            <span class="help-block"></span>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Re Type Password</label>
                                            <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-primary">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="signup_process();">Signup</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </form>
                            <!-- /Form-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
                    <!-- Logout Modal -->
                    <div class="modal modal-danger fade" id="modal_user_logout">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p><b>Are you sure, you want to logout?</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-outline" onclick="confirm_userlogged_out();">Confirm</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->        
                    <div class="row">
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/15069695283d6443e8.JPG" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/15069695283d6443e8.JPG" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/15066663263951547f.JPG" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/15066663263951547f.JPG" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/150666616630cbced9.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/150666616630cbced9.jpg" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/15071358423a74ce23.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/15071358423a74ce23.jpg" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/15066657433fc271f9.JPG" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/15066657433fc271f9.JPG" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3-cust">
                            <div class="text-center">
                                <a class="example-image-link" href="http://localhost/artgoobi/uploads/150665932136d931a6.JPG" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img class="example-image rounded mx-auto d-block image_show_case" src="http://localhost/artgoobi/uploads/150665932136d931a6.JPG" alt=""/>
                                </a>
                            </div>
                        </div>
                    </div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
                Commercial
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
                Commercial
            </div>
        </div>
    </div>
</div><!-- main row ---> 
<div class="row">
    <div class="col-md-12">
        <ul class="list-inline">
            <li>About us</li>
            <li>Contact</li>
            <li>Terms and Policy</li>
            <li>Settings</li>
            <li>Help</li>
        </ul>
    </div>
</div>
        </div><!-- Container fluid End --->
    </body>
</html>

