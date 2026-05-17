<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\seo_settings;
use App\Models\Admin\page_seo;



class seo_setting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      seo_settings::create([
          'site_name' => 'Picklet',
          'site_tagline' => 'Your Trusted Online Marketplace',
          'default_meta_title' => 'Picklet - Best Online Shopping in Bangladesh',
          'default_meta_description' => 'Shop the best products at Picklet. Electronics, Fashion, Home & more with fast delivery and best prices in Bangladesh.',
          'default_og_image' => '/uploads/seo/default-og-image.jpg',
          'favicon' => '/uploads/seo/favicon.ico',
          'google_analytics_id' => 'G-XXXXXXXXXX',
          'google_search_console' => 'null',
          'bing_webmaster' => 'null',
          'schema_organization' => json_encode([
              "@context" => "https://schema.org",
              "@type" => "Organization",
              "name" => "Picklet",
              "url" => "https://picklet.com",
              "logo" => "https://picklet.com/uploads/logo.png",
              "contactPoint" => [
                  "@type" => "ContactPoint",
                  "telephone" => "+880-1XXX-XXXXXX",
                  "contactType" => "Customer Service"
              ],
              "sameAs" => [
                  "https://www.facebook.com/picklet",
                  "https://www.instagram.com/picklet"
              ]
          ], JSON_UNESCAPED_SLASHES),
      ]);
      page_seo::create([
          'page_url' => '/', // হোমপেজের জন্য
          'meta_title' => 'Picklet - Best Online Shopping in Bangladesh',
          'meta_description' => 'Shop electronics, fashion, home essentials & more at Picklet. Fast delivery, cash on delivery, best prices guaranteed in Bangladesh.',
          'meta_keywords' => 'picklet, online shopping bd, ecommerce bangladesh, buy online',
          'og_image' => '/uploads/seo/home-og.jpg',
          'canonical_url' => 'https://picklet.com/',
          'robots_meta' => 'index, follow',
      ]);
            
    }
}
