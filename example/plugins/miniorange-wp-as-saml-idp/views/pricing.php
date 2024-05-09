<?php
/**
 * This is the file for displaying the view under
 * the Upgrade Plans (Pricing) tab.
 *
 * @package miniorange-wp-as-saml-idp\views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



echo '<div class="mo-idp-divided-layout mo-idp-full mo-idp-bg mo-idp-pt mo-idp-margin-left mo-idp-full">';
		is_customer_registered_idp( $registered );
echo '   <form style="display:none;" id="mo_idp_request_quote_form" action="admin.php?page=idp_support" method="post">
            <input type="text" name="plan_name" id="plan-name" value="" />
            <input type="text" name="plan_users" id="plan-users" value="" />
        </form>';
	echo '    
        <form style="display:none;" id="mocf_loginform" action="' . esc_url( $login_url ) . '" target="_blank" method="post">
            <input type="email" name="username" value="' . esc_attr( $username ) . '" />
            <input type="text" name="redirectUrl" value="' . esc_url( $payment_url ) . '" />
            <input type="text" name="requestOrigin" id="requestOrigin"  />
        </form>';
	echo '    
    <div class="mo-idp-center mo-idp-sp-width mo-idp-table-layout" style="height: 100%; padding-bottom:5rem;">
    <h2 class="mo-idp-add-new-sp">Licensing Plans</h2>
    <hr class="mo-idp-add-new-sp-hr">  
    <br>                  
        
<div class="container-fluid  pricing-padding saml-scroll">
</div>

 <div class="dropdown-padding col-md-12" style="
  left: -7%; 
  align-items: center;
  display: flex;
  gap: 1rem;
  justify-content: center;
  padding: 1rem 5rem; 
  position: relative;
  width: 100%; 
">
  <div id="monthly-users" style="margin-top:2.8rem;">
    <span class="visitor-text">Number of Users</span>
  </div>
    <div id="slider-view" class="officient-pricing slide-view " style="width:60%">
        <div class="officient-pricing--contain ">
          <div class="officient-pricing--slider">
            <div id="priceTag" class="officient-slider--number backgrd-number" style="left: 1%;">100</div>
            <input id="userVal" type="range" min="100" max="800" value="100" l="" class="officient--rangeslider" oninput="priceChange(this.value)" onchange="priceChange(this.value)" style="background: linear-gradient(to right, rgb(114 109 157) 0%, rgb(27 34 165) 57.1429%, rgb(245, 245, 245) 57.1429%, rgb(245, 245, 245) 100%);"><br>
              
              <div class="tick-container" id="tickContainer">
                <div class="tick" style="margin-left: 0.6rem;"></div>
                <div class="tick" style="margin-left: 11.6rem;"></div>
                <div class="tick" style="margin-left: 11.4rem;"></div>
                <div class="tick" style="margin-left: 11.1rem;"></div>
                <div class="tick" style="margin-left: 11.3rem;"></div>
                <div class="tick" style="margin-left: 11.3rem;"></div>
                <div class="tick" style="margin-left: 11.4rem;"></div>
                <div class="tick" style="margin-left: 11.5rem;"></div>
              </div>             
            </div>
            <div class="listnumbers">
                  <span class="numbers" style="margin-left:0rem;" onclick="numPriceChange(100)">100</span>
                  <span class="numbers" style="margin-left: 3.7rem;" onclick="numPriceChange(200)">200</span>
                  <span class="numbers" style="margin-left: 3.6rem;" onclick="numPriceChange(300)">300</span>
                  <span class="numbers" style="margin-left: 3.3rem;" onclick="numPriceChange(400)">400</span>
                  <span class="numbers" style="margin-left: 3.1rem;" onclick="numPriceChange(500)">500</span>
                  <span class="numbers" style="margin-left: 3rem;" onclick="numPriceChange(600)">1000</span>
                  <span class="numbers" style="margin-left: 3rem;" onclick="numPriceChange(700)">2000</span>
                  <span class="numbers" style="margin-left: 3rem;" onclick="numPriceChange(800)">2000+</span>
            </div>
          </div>     
        </div>
              <div class="better-deal">
                  <input type="button" class="btn better-deal-btn" value="More users, Better deal!">
                  <span id="tooltip-price" class="pricing-des" style="display: none;"> 
                  We\'ve got you covered with our bulk discount options. Contact us at <a href="mailto:wpidpsupport@xecurify.com" class="text-orange" target="_blank" style:"color:#0b6bb8">wpidpsupport@xecurify.com</a> to discuss a tailored pricing solution.
                  </span>
              </div>
      <div class="idp-sub-price-tr1 d-flex justify-content-center dropdown-view">
          <select id="dropdown-val" class="usr-slb" name="users" oninput="priceChange(this.value)" onchange="priceChange(this.value)">
              <option value="100">1-100 Users</option>
              <option value="200">101-200 Users</option>
              <option value="300">201-300 Users</option>
              <option value="400">301-400 Users</option>
              <option value="500">401-500 Users</option>
              <option value="600">501-1000 Users</option>
              <option value="700">1001-2000 Users</option>
              <option value="800">2000+ Users</option>  
          </select>
      </div>
</div>

<div class="pricing-plan-cards" >
<div class="row handler single-site text-center  margin-xl" id="pricing-single-site">
    <div class="reg-plans-saml single-site-rot common-rot">
        <div class="row " >
            
            <div class="col-md-5 incl-plan-saml-1  hover-saml" >
                <div class="card1-top">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="74" viewBox="0 0 72 72" fill="none">
                            <rect width="72" height="72" rx="16" fill="#f2f5ff"/>
                            <path d="M36 17C30.9609 17 26.1282 19.0018 22.565 22.565C19.0018 26.1282 17 30.9609 17 36C17 41.0391 19.0018 45.8718 22.565 49.435C26.1282 52.9982 30.9609 55 36 55L36 36L36 17Z" fill="#2271b1"/>
                            <path d="M36 55C41.0391 55 45.8718 52.9982 49.435 49.435C52.9982 45.8718 55 41.0391 55 36C55 30.9609 52.9982 26.1282 49.435 22.565C45.8718 19.0018 41.0391 17 36 17L36 36L36 55Z" fill="#d5e2ff"/>
                            </svg>
                    </div>
                    <div>
                        <p class="text-dark-grey second-title-ft font-poppins" style:"font-size:13px;">Perfect to get started</p>
                        <h3 class="header-plan text-left text-al-cent color-42">FREE</h3>
                    </div>
                </div>
                
                <p class="text-left text-al-cent free-price" style="text-align:left;"><span class="display-1 "><span id="user-price">$0</span>
                </span></p>
                <div class="price-list mt-5">
                    <ul class="pl-0">
                        <p  class="whats-include mt-10">What\'s Included</p>

                        <li class="choose-plan-1 text-left mr-lt-2">
                        <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                        <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                        <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></div>

                        <div>Single Sign-On</div>
                        </li>

                        <li class="choose-plan-1 text-left mr-lt-2">
                        <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                        <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                        <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></div>
                        <div>Supports only 1 Service Provider</div>                         
                        </li>

                        <li class="choose-plan-1 text-left">
                          <div class="d-flex"><svg fill="#3b3b3b" width="30" height="30" viewBox="0 0 30 30" version="1.1"  xmlns="http://www.w3.org/2000/svg" stroke="#3b3b3b">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title>
                          <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z">
                          </path></g></svg></div>
                          <div>Single Logout</div>
                        </li>
                     
                        <li class="choose-plan-1 text-left">
                          <div class="d-flex"><svg fill="#3b3b3b" width="30" height="30" viewBox="0 0 30 30" version="1.1"  xmlns="http://www.w3.org/2000/svg" stroke="#3b3b3b">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title>
                          <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z">
                          </path></g></svg></div>
                          <div>Widget/shortcode to add SP login</div>
                        </li>

                        <li class="choose-plan-1 text-left">
                          <div class="d-flex"><svg fill="#3b3b3b" width="30" height="30" viewBox="0 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#3b3b3b">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title>
                          <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z">
                          </path></g></svg></div>
                          <div>Customized Attribute & Role Mapping</div>
                        </li>

                        <li class="choose-plan-1 text-left">
                          <div class="d-flex"><svg fill="#3b3b3b" width="30" height="30" viewBox="0 0 30 30" version="1.1"  xmlns="http://www.w3.org/2000/svg" stroke="#3b3b3b">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title>
                          <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z">
                          </path></g></svg></div>
                          <div>Default Login Page</div>
                        </li>

                        <li class="choose-plan-1 text-left">
                          <div class="d-flex"><svg fill="#3b3b3b" width="30" height="30" viewBox="0 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#3b3b3b">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title>
                          <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z">
                          </path></g></svg></div>
                          <div>Signed Responses</div>
                        </li>

                    </ul>
                </div><br>
                <div style="margin: auto 4.3rem;">
                    <a href="https://wordpress.org/plugins/miniorange-wp-as-saml-idp/" target="_blank" id="download-for-now" class="price-btn-padding btn license-btn-saml-1 font-poppins" style="text-decoration: none;">TRY NOW FOR FREE</a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row handler single-site text-center margin-xl" id="pricing-single-site">
    <div class="col-md-4 reg-plans-saml single-site-rot common-rot">
        <div class="row" >
            
            <div class="col-md-5 incl-plan-saml-2  hover-saml">
                <div class="card2-top">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">
                            <rect width="72" height="72" rx="16" fill="#f2f5ff"/>
                            <rect x="35.4863" y="17" width="19.5135" height="38" fill="#d5e2ff"/>
                            <rect x="17" y="17" width="18.4865" height="38" fill="#2271b1"/>
                            <rect x="35.4863" y="35.4863" width="19.5135" height="19.5135" fill="#f7f7f7"/>
                            </svg>
                    </div>
                    <div>
                        <p id="powerdom" class="text-dark-grey second-title-ft font-poppins">Power up your Business</p>
                        <h3 class="header-plan text-left text-al-cent">PREMIUM</h3>
                    </div>

                </div>
                <div id="paymentMethod">
                 <div  class="payment-method">
                  <span class="text-dark-grey pay-method">
                      Prepaid
                  </span>
                  <span class="text-dark-grey pay-method">
                      Postpaid
                  </span>
                 </div>
                </div>
                <div id="PricingDom" >
                  <div class="Price-display">
                      <div id="yearlyfirst-price">
                          <p class=" text-left font-size-16">
                              <div class="officient-pricing--info display-2">
                                  <div id="userInput" class="officient-info--price  text-left"> </div>
                              <span id="yearly" class="text-dark-grey subscription">/ year</span>
                              </div>
                          </p>
                      </div>
                        <hr class="text-left hr-display">
                      <div id="monthly-price" class="monthlyP-border">
                          <p  class=" text-left font-size-16">
                              <div class="officient-pricing--info display-2 marg-left-3">
                              <div id="userInputMonthly" class="officient-info--price  text-left"> </div>
                              <span id="monthly" class="text-dark-grey subscription">/ month</span>
                              </div>
                          </p>
                      </div>
                  </div>
    
                </div>

                <div id="contact-idp" class="contactus-display" style="display:none; cursor:pointer">
                    <input id="sales-enquiry" type="button" onclick="gatherplaninfo(\'all_inclusive\',\'5K\')" class="btn contactus-btn marg-contactus" style="cursor:pointer" Value = "Contact Us" >
                </div>
               
          <div class="price-list mt-5">
              <ul class="pl-0">
                <p class="mt-46 whats-include">What\'s Included</p>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>
                  <div>SAML / OAuth Single Sign-On</div>
              </li>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>
                  <div>Multiple Service Providers / OAuth clients with additional cost of $50 per SP</div>
              </li>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>
                  <div>Single Logout</div>
              </li>


              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>  
                  <div>Widget/shortcode to add SP login</div>
                </li>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div> 
                  <div>Customized Attribute & Role Mapping</div>
              </li>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>   
                  <div>Custom Login Page</div>
              </li>

              <li class="choose-plan-2 text-left">
                  <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 27 27" fill="none">
                  <path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#2271b1"/>
                  <path d="M7.11682 13.8405L10.4786 17.2023L18.8832 8.79773" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg></div>   
                  <div>Signed Responses, SAML Request Verification & Assertion Encryption</div>
              </li>

             </ul>
            </div>
            <br>
            <div style="margin: auto 4.8rem">
                <a href="https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&amp;requestOrigin=wp_saml_idp_premium_plan" style="text-decoration: none;" target="_blank" class=" license-btn-saml-2 font-poppins">UPGRADE NOW</a>
            </div>
            
            </div>

        </div>
    </div>
</div>

</div>
</div>
<div class="mo-idp-table-layout mo-idp-center mo-idp-sp-width">
    <h3>How our Licensing works?</h3>
    <p>
    The <b>WordPress IDP Premium</b> plugin is an <b>annual subscription</b>, and the pricing depends upon the number of <b>SSO provisioned users</b> and the number of <b>Service Providers</b>. Any user who performs the SSO at least once, is an SSO provisioned user. You can free up the used SSO seats by deleting the users from the WordPress admin dashboard.  
    <br>
    Once you reach the <b>80%</b> of your purchased user license limit, you will automatically receive email notification on your registered email address.
    At this point, you can reach out to us at <a href="mailto:wpidpsupport@xecurify.com">wpidpsupport@xecurify.com</a> or using the support form in the plugin, and we will assist you with the upgrade.<br>
    Post expiry there will be 15 days grace period to renew your license, otherwise the <span class="mo-idp-red"><b>SSO will be disabled</b></span>.  
    </p>
</div>
<div id="disclaimer" class="mo-idp-table-layout mo-idp-center mo-idp-sp-width">
    <h3>* Steps to Upgrade to Premium Plugin -</h3>
    <p>
        1. You will be redirected to miniOrange Login Console. 
        Enter your password with which you created an account with us. 
        After that you will be redirected to payment page.
    </p>
    <p>
        2. Enter you card details and complete the payment. 
        On successful payment completion, you will see the link to download the premium plugin.
    </p>
    <p>
        3. Once you download the premium plugin, just unzip it and replace the folder with existing plugin. <br>
        <b>Note: Do not first delete and upload again from WordPress admin panel as your already saved settings will get lost.</b></p>
        <p>4. From this point on, do not update the plugin from the WordPress store.</p>
        <h3>** End to End Integration - </h3>
        <p> 
            We will setup a Conference Call / GoToMeeting and do end to end configuration for you. 
            We provide services to do the configuration on your behalf. 
        </p>
        If you have any doubts regarding the licensing plans, you can mail us at 
        <a href="mailto:wpidpsupport@xecurify.com"><i>wpidpsupport@xecurify.com</i></a> 
        or submit a query using the <b>support form</b>.
    </p>
</div>
<div class="mo-idp-table-layout mo-idp-center mo-idp-sp-width">
    <h3>10 Days Return Policy</h3>
    <p>
        At miniOrange, we want to ensure you are 100% happy with your purchase.  If the Premium plugin you purchased is not working as
        advertised and you have attempted to resolve any feature issues with our support team, which couldn\'t get resolved, then we will
        refund the whole amount within 10 days of the purchase. Please email us at
        <a href="mailto:wpidpsupport@xecurify.com">wpidpsupport@xecurify.com</a> for any queries regarding the return policy.
        <br> If you have any doubts regarding the licensing plans, you can mail us at 
        <a href="mailto:wpidpsupport@xecurify.com">wpidpsupport@xecurify.com</a> or submit a query using the support form.
    </p>
</div>
</div>';
