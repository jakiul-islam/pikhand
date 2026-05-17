<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\help;

class HelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      help::create([
        'page' => '
          <style>
              .help-hero {
                  background: #4F46E5;
                  color: #fff;
                  padding: 80px 0;
              }
              .help-search {
                  max-width: 600px;
                  margin: 0 auto;
              }
              .help-search .form-control {
                  height: 55px;
                  border-radius: 50px;
                  padding-left: 25px;
                  border: none;
              }
              .help-search .btn {
                  border-radius: 50px;
                  padding: 0 30px;
                  position: absolute;
                  right: 5px;
                  top: 5px;
                  height: 45px;
              }
              .category-card {
                  border: 1px solid #e5e7eb;
                  border-radius: 12px;
                  transition: all 0.3s ease;
                  text-decoration: none;
                  color: inherit;
              }
              .category-card:hover {
                  border-color: #4F46E5;
                  box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
                  transform: translateY(-2px);
              }
              .category-icon {
                  width: 50px;
                  height: 50px;
                  background: #eef2ff;
                  color: #4F46E5;
                  border-radius: 12px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  font-size: 24px;
              }
              .accordion-button:not(.collapsed) {
                  background-color: #eef2ff;
                  color: #4F46E5;
                  box-shadow: none;
              }
              .accordion-button:focus {
                  box-shadow: none;
                  border-color: #e5e7eb;
              }
          </style>

          <!-- Hero + Search -->
          <section class="help-hero text-center">
              <div class="container">
                  <h1 class="fw-bold mb-3">How can we help you?</h1>
                  <p class="lead mb-4 opacity-75">Search your question or browse categories below</p>
                  <div class="help-search position-relative">
                      <input type="text" class="form-control" placeholder="Search for help..." id="faqSearch">
                      <button class="btn btn-light text-primary fw-semibold">Search</button>
                  </div>
              </div>
          </section>
          
          <!-- Help Categories -->
          <section class="py-5">
              <div class="container">
                  <div class="row g-4 mb-5">
                      <div class="col-md-6 col-lg-3">
                          <a href="#orders" class="category-card card p-4 text-center h-100">
                              <div class="category-icon mx-auto mb-3">
                                  <i class="bi bi-box-seam"></i>
                              </div>
                              <h6 class="fw-semibold mb-1">Orders</h6>
                              <p class="text-muted small mb-0">Track, cancel, return</p>
                          </a>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <a href="#shipping" class="category-card card p-4 text-center h-100">
                              <div class="category-icon mx-auto mb-3">
                                  <i class="bi bi-truck"></i>
                              </div>
                              <h6 class="fw-semibold mb-1">Shipping</h6>
                              <p class="text-muted small mb-0">Delivery time & cost</p>
                          </a>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <a href="#payment" class="category-card card p-4 text-center h-100">
                              <div class="category-icon mx-auto mb-3">
                                  <i class="bi bi-credit-card"></i>
                              </div>
                              <h6 class="fw-semibold mb-1">Payment</h6>
                              <p class="text-muted small mb-0">bKash, Nagad, Card</p>
                          </a>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <a href="#account" class="category-card card p-4 text-center h-100">
                              <div class="category-icon mx-auto mb-3">
                                  <i class="bi bi-person-circle"></i>
                              </div>
                              <h6 class="fw-semibold mb-1">Account</h6>
                              <p class="text-muted small mb-0">Login, password, profile</p>
                          </a>
                      </div>
                  </div>
          
                  <!-- FAQ Accordion -->
                  <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <h2 class="fw-bold mb-4 text-center">Frequently Asked Questions</h2>
                          
                          <div class="accordion" id="faqAccordion">
                              <!-- Orders -->
                              <h5 class="mt-4 mb-3" id="orders"><i class="bi bi-box-seam me-2 text-primary"></i>Orders</h5>
                              
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                          How do I track my order?
                                      </button>
                                  </h2>
                                  <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          After your order is shipped, we will send you a tracking number via SMS and Email. 
                                          You can also track it from <strong>My Account > My Orders</strong> section. Click on "Track Order" button.
                                      </div>
                                  </div>
                              </div>
          
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                          Can I cancel my order?
                                      </button>
                                  </h2>
                                  <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          Yes, you can cancel your order before it is shipped. Go to <strong>My Orders</strong> and click "Cancel Order". 
                                          If already shipped, you can refuse delivery or return it after receiving. COD orders will be cancelled instantly. 
                                          For prepaid orders, refund will be processed within 7-10 working days.
                                      </div>
                                  </div>
                              </div>
          
                              <!-- Shipping -->
                              <h5 class="mt-5 mb-3" id="shipping"><i class="bi bi-truck me-2 text-primary"></i>Shipping & Delivery</h5>
                              
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                          How long does delivery take?
                                      </button>
                                  </h2>
                                  <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          <strong>Inside Dhaka:</strong> 1-3 working days<br>
                                          <strong>Outside Dhaka:</strong> 3-5 working days<br>
                                          <strong>Remote Areas:</strong> 5-7 working days<br>
                                          Delivery time may vary during campaigns like 11.11, Eid Sale.
                                      </div>
                                  </div>
                              </div>
          
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                          What are the delivery charges?
                                      </button>
                                  </h2>
                                  <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          <strong>Inside Dhaka:</strong> 60 BDT<br>
                                          <strong>Outside Dhaka:</strong> 120 BDT<br>
                                          Free delivery for orders above 2000 BDT nationwide.
                                      </div>
                                  </div>
                              </div>
          
                              <!-- Payment -->
                              <h5 class="mt-5 mb-3" id="payment"><i class="bi bi-credit-card me-2 text-primary"></i>Payment</h5>
                              
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                          What payment methods do you accept?
                                      </button>
                                  </h2>
                                  <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          We accept: <br>
                                          1. Cash on Delivery (COD)<br>
                                          2. bKash<br>
                                          3. Nagad<br>
                                          4. Visa/Mastercard/Amex via SSLCommerz<br>
                                          All online payments are 100% secure and encrypted.
                                      </div>
                                  </div>
                              </div>
          
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                          My payment failed but money was deducted. What to do?
                                      </button>
                                  </h2>
                                  <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          Dont worry. If payment fails but money is deducted, it will be automatically refunded to your 
                                          account within 7-10 working days. Please contact us at <strong>support@piclet.com</strong> 
                                          with your Order ID and Transaction ID for faster resolution.
                                      </div>
                                  </div>
                              </div>
          
                              <!-- Account -->
                              <h5 class="mt-5 mb-3" id="account"><i class="bi bi-person-circle me-2 text-primary"></i>Account</h5>
                              
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                          I forgot my password. How to reset?
                                      </button>
                                  </h2>
                                  <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                      <div class="accordion-body text-muted">
                                          Click on "Forgot Password" on the login page. Enter your registered email or phone number. 
                                          We will send you an OTP to reset your password. 
                                      </div>
                                  </div>
                              </div>
          
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          
          <!-- Contact Support -->
          <section class="py-5 bg-light">
              <div class="container">
                  <div class="row justify-content-center text-center">
                      <div class="col-lg-8">
                          <h3 class="fw-bold mb-3">Still need help?</h3>
                          <p class="text-muted mb-4">Our customer support team is here to help you 24/7</p>
                          <div class="d-flex justify-content-center gap-3 flex-wrap">
                              <a href="tel:01700000000" class="btn btn-primary">
                                  <i class="bi bi-telephone-fill me-2"></i>Call: 01700-000000
                              </a>
                              <a href="mailto:support@piclet.com" class="btn btn-outline-primary">
                                  <i class="bi bi-envelope-fill me-2"></i>Email Us
                              </a>
                              <a href="https://wa.me/8801700000000" target="_blank" class="btn btn-success">
                                  <i class="bi bi-whatsapp me-2"></i>WhatsApp
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </section>


        <script>
        // Simple FAQ Search
        document.getElementById("faqSearch").addEventListener("keyup", function() {
            let searchTerm = this.value.toLowerCase();
            let items = document.querySelectorAll(".accordion-item");
            
            items.forEach(item => {
                let text = item.textContent.toLowerCase();
                if(text.includes(searchTerm)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
        </script>'
      ]);
    }
}
