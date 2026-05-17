<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\policie;

class PolicieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      policie::create([
        'page' => '
        <style>
          .policy-container {
              max-width: 900px;
              margin: 40px auto;
              padding: 20px 30px;
              background: #ffffff;
              border-radius: 8px;
              box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
              font-family: "Hind Siliguri", "Poppins", sans-serif;
              color: #333;
              line-height: 1.8;
          }
          
          .policy-container h2 {
              font-size: 32px;
              font-weight: 700;
              color: #1a202c;
              margin-bottom: 10px;
              padding-bottom: 15px;
              border-bottom: 3px solid #4F46E5; /* Piclet ব্র্যান্ড কালার */
          }
          
          .policy-container h4 {
              font-size: 20px;
              font-weight: 600;
              color: #2d3748;
              margin-top: 35px;
              margin-bottom: 12px;
          }
          
          .policy-container p {
              font-size: 16px;
              color: #4a5568;
              margin-bottom: 16px;
              text-align: justify;
          }
          
          .policy-container p strong {
              color: #1a202c;
              font-weight: 600;
          }
          
          .policy-container ul {
              list-style: none;
              padding-left: 0;
              margin-bottom: 20px;
          }

          .policy-container ul li {
              position: relative;
              padding-left: 28px;
              margin-bottom: 12px;
              font-size: 16px;
              color: #4a5568;
          }
          
          /* লিস্টের আগে চেকমার্ক আইকন */
          .policy-container ul li::before {
              content: "✓";
              position: absolute;
              left: 0;
              top: 0;
              color: #4F46E5; /* ব্র্যান্ড কালার */
              font-weight: bold;
              font-size: 18px;
          }
          
          .policy-container ul li strong {
              color: #2d3748;
          }

          /* Last updated ডেট হাইলাইট */
          .policy-container p:has(strong:contains("Last updated")) {
              background: #f7fafc;
              padding: 10px 15px;
              border-left: 4px solid #4F46E5;
              border-radius: 4px;
              font-size: 14px;
          }
          
          /* Responsive */
          @media (max-width: 768px) {
              .policy-container {
                  margin: 20px 15px;
                  padding: 20px 20px;
              }
              
              .policy-container h2 {
                  font-size: 26px;
              }
              
              .policy-container h4 {
                  font-size: 18px;
              }
              
              .policy-container p, .policy-container ul li {
                  font-size: 15px;
              }
          }
        </style>
        
        <h2>Privacy Policy for Piclet</h2>
        <p><strong>Last updated: April 21, 2026</strong></p>
        
        <p>Piclet ("we", "our", or "us") operates the website www.piclet.com. This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service.</p>

        <h4>1. Information We Collect</h4>
        <p>We collect several different types of information for various purposes to provide and improve our Service to you:</p>
        <ul>
            <li><strong>Personal Data:</strong> Name, email address, phone number, shipping address, billing address.</li>
            <li><strong>Payment Data:</strong> We do not store your card details. All payments are processed securely through SSLCommerz/bKash/Nagad.</li>
            <li><strong>Usage Data:</strong> We may collect information on how the Service is accessed and used. This may include your IP address, browser type, pages visited.</li>
        </ul>

        <h4>2. How We Use Your Data</h4>
        <ul>
            <li>To process and deliver your orders.</li>
            <li>To notify you about the status of your order.</li>
            <li>To provide customer support.</li>
            <li>To send you promotional offers, only if you opt-in. You can opt-out anytime.</li>
            <li>To detect and prevent fraud.</li>
        </ul>

        <h4>3. Data Security</h4>
        <p>The security of your data is important to us. We use commercially acceptable means to protect your Personal Data, but remember that no method of transmission over the Internet is 100% secure.</p>
        
        <h4>4. Sharing Your Information</h4>
        <p>We do not sell your personal data. We only share it with third parties necessary to run our business: delivery partners like RedX/Pathao, and payment gateways, solely for the purpose of completing your order.</p>

        <h4>5. Your Rights</h4>
        <p>You have the right to access, update, or delete the information we have on you. Please contact us at support@piclet.com for any requests.</p>

        <h4>6. Cookies</h4>
        <p>We use cookies to track activity on our Service and hold certain information. You can instruct your browser to refuse all cookies.</p>

        <h4>7. Contact Us</h4>
        <p>If you have any questions about this Privacy Policy, please contact us at: 

 
        <h2>Terms & Conditions</h2>
        <p>By accessing this website, you are agreeing to be bound by these terms of service. </p>
        <h4>1. Orders</h4>
        <p>All orders are subject to product availability. We reserve the right to cancel any order.</p>
        <h4>2. Pricing</h4>
        <p>All prices are in BDT and are subject to change without notice.</p>
        <h4>3. Payment</h4>
        <p>We accept Cash on Delivery, bKash, Nagad, and Cards via SSLCommerz.</p>
   

       
        <h2>Return & Refund Policy</h2>
        <h4>1. Return Period</h4>
        <p>You can return a product within 7 days of delivery if it meets our return conditions.</p>
        <h4>2. Return Conditions</h4>
        <ul>
            <li>Product must be unused and in original packaging.</li>
            <li>Must have the original invoice.</li>
            <li>Certain items like undergarments are non-returnable for hygiene reasons.</li>
        </ul>
        <h4>3. Refund Process</h4>
        <p>Once we receive and inspect the return, refunds will be processed within 7-10 working days to your original payment method.</p>
   

   
        <h2>About Piclet</h2>
        <p>Welcome to Piclet, your number one source for all things quality. We are dedicated to giving you the very best products, with a focus on quality, customer service, and uniqueness.</p>
        <p>Founded in 2024, Piclet has come a long way from its beginnings. We now serve customers all over Bangladesh and are thrilled to be a part of the eco-friendly wing of the eCommerce industry.</p>
        <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions, please contact us.</p>
       ',
      ]);
    }
}
