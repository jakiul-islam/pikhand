<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\about;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      about::create([
        'page' => '
        <style>
            .about-hero {
                background: linear-gradient(rgba(79, 70, 229, 0.9), rgba(79, 70, 229, 0.9)), 
                color: #fff;
                padding: 100px 0;
            }
            .about-hero h1 {
                font-size: 3rem;
                font-weight: 700;
            }
            .about-icon {
                width: 70px;
                height: 70px;
                background: #eef2ff;
                color: #4F46E5;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 30px;
                margin: 0 auto 20px;
            }
            .team-img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border: 4px solid #eef2ff;
            }
            .stats-card {
                background: #f8f9fa;
                border: none;
                border-radius: 12px;
            }
        </style>

        <!-- Hero Section -->
        <section class="about-hero text-center">
            <div class="container">
                <h1 class="mb-3">About Piclet</h1>
                <p class="lead mb-0">Your trusted partner for quality products across Bangladesh</p>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1522071820481-02144c0d75d4?q=80&w=2070" 
                             class="img-fluid rounded-3 shadow-sm" alt="Our Team">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-3">Our Story</h2>
                        <p class="text-muted mb-3">
                            Welcome to <strong>Piclet</strong>, your number one source for all things quality. Founded in 2024 in Mymensingh, 
                            Piclet has come a long way from its beginnings. When we first started out, our passion for 
                            providing the best products drove us to start our own business.
                        </p>
                        <p class="text-muted mb-0">
                            We are dedicated to giving you the very best products, with a focus on quality, customer service, and uniqueness. 
                            We now serve customers all over Bangladesh and are thrilled to be a part of the eco-friendly wing of the eCommerce industry.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Why Choose Us -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Why Choose Piclet?</h2>
                    <p class="text-muted">We are committed to excellence in every aspect</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 text-center p-4 h-100">
                            <div class="about-icon">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <h5 class="fw-semibold">Quality Products</h5>
                            <p class="text-muted small mb-0">We source only the best products and check quality before delivery.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 text-center p-4 h-100">
                            <div class="about-icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h5 class="fw-semibold">Fast Delivery</h5>
                            <p class="text-muted small mb-0">Quick delivery across Bangladesh with trusted partners like RedX & Pathao.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 text-center p-4 h-100">
                            <div class="about-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h5 class="fw-semibold">24/7 Support</h5>
                            <p class="text-muted small mb-0">Our customer support team is always ready to help you with any query.</p>
                        </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 text-center p-4 h-100">
                            <div class="about-icon">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </div>
                            <h5 class="fw-semibold">Easy Returns</h5>
                            <p class="text-muted small mb-0">Hassle-free 7-day return policy if you are not satisfied.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Stats Section -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-6 col-md-3">
                        <div class="card stats-card p-4">
                            <h3 class="fw-bold text-primary mb-1">10K+</h3>
                            <p class="text-muted mb-0">Happy Customers</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stats-card p-4">
                            <h3 class="fw-bold text-primary mb-1">500+</h3>
                            <p class="text-muted mb-0">Products</p>
                        </div>
                    <div class="col-6 col-md-3">
                        <div class="card stats-card p-4">
                            <h3 class="fw-bold text-primary mb-1">64</h3>
                            <p class="text-muted mb-0">Districts Covered</p>
                        </div>
                    <div class="col-6 col-md-3">
                        <div class="card stats-card p-4">
                            <h3 class="fw-bold text-primary mb-1">4.8★</h3>
                            <p class="text-muted mb-0">Customer Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Our Mission -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="fw-bold mb-3">Our Mission</h2>
                        <p class="lead text-muted">
                            "To make quality products accessible to everyone in Bangladesh through a seamless online shopping experience, 
                            backed by exceptional customer service and lightning-fast delivery."
                        </p>
                        <a href="" class="btn btn-primary btn-lg mt-3 px-4">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
        ',
      ]);
    }
}
