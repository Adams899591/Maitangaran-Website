if this is how i design the mobile app import React, { useEffect, useState } from 'react';
import { View, Text, FlatList, Image, Dimensions, ActivityIndicator, TouchableOpacity } from 'react-native';
import { MaterialCommunityIcons, Ionicons } from '@expo/vector-icons'; // <-- Added Ionicons import here
import axios from 'axios';
import { useRouter } from 'expo-router';

const { width } = Dimensions.get('window');

export default function FeaturedProducts({ SectionHeader, EmptySectionState, ImagePlaceholder }) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true); 
  const router = useRouter();
  const [networkError, setNetworkError] = useState(false);

  // Send request API to fetch Featured Products
  const fetchFeaturedProducts = async () => {
    try {
      setLoading(true);
      setNetworkError(false); // Reset to false on retry
           const response = await axios.get(`${process.env.EXPO_PUBLIC_API_URL}/products/featured`, {
                            headers: {
                              'Content-Type': 'application/json',
                              'X-Api-Key': process.env.EXPO_PUBLIC_API_KEY,
                            },
                          });
     
      const res = response.data;

      if (res && res.Success && Array.isArray(res.Data)) {
        setProducts(res.Data);
      } else {
        setProducts([]);
      }
    } catch (error) {
      console.log("Error fetching featured products:", error);
      setNetworkError(true); 
      setProducts([]);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchFeaturedProducts();
  }, []);

  // 1. Check loading status first
  if (loading) {
    return (
      <View className="mt-8 h-48 items-center justify-center">
        <ActivityIndicator size="large" color="#000" />
      </View>
    );
  }

  // 2. FIXED ORDER: Check for network errors BEFORE checking if products array is empty
  if (networkError) {
    return (
      <View className="mt-8 mx-4 bg-red-50 border border-red-100 rounded-2xl items-center justify-center p-6 h-44">
        <Ionicons name="cloud-offline-outline" size={26} color="#EF4444" />
        <Text className="text-gray-900 text-xs font-bold mt-2 text-center">
          Failed to load products
        </Text>
        <TouchableOpacity 
          onPress={fetchFeaturedProducts}
          className="mt-3 bg-black px-4 py-1.5 rounded-full"
        >
          <Text className="text-white text-[10px] font-bold tracking-wider">RETRY</Text>
        </TouchableOpacity>
      </View>
    );
  }

  // 3. Only show empty state if the network call was successful but returned no items
  if (products.length === 0) {
    return <EmptySectionState heightClass="h-48" message="No featured fabric groupings found." />;
  }

  return (
    <View className="mt-8">
      <SectionHeader 
        title="FEATURED PRODUCT" 
        rightElement={
          <View className="flex-row items-center space-x-2">
            <View className="flex-row items-center bg-gray-50 px-2 py-0.5 rounded-md border border-gray-100 mr-1.5">
              <MaterialCommunityIcons name="gesture-swipe-horizontal" size={12} color="#9CA3AF" />
              <Text className="text-[9px] font-bold text-gray-400 ml-1 uppercase">Swipe</Text>
            </View>
            <Text className="text-xs font-bold text-gray-400 tracking-wider">EXPLORE LINEUP</Text>
          </View>
        }
      />
      
      <FlatList
        data={products}
        horizontal
        showsHorizontalScrollIndicator={false}
        contentContainerStyle={{ paddingHorizontal: 16 }}
        keyExtractor={(item) => `featured-${item.ID}`}
        renderItem={({ item }) => {
          const hasDiscount = item.OnlineRate && Number(item.OnlineRate) < Number(item.SellingPrice);

          return (
            <View 
              style={{ width: width * 0.44 }} 
              className="bg-white border border-gray-100 rounded-2xl overflow-hidden p-2 mr-4"
            >
              <View className="bg-gray-50 rounded-xl overflow-hidden">
                {item.SmallImage ? (
                  <Image source={{ uri: item.SmallImage }} className="w-full h-36 object-cover" />
                ) : (
                  <ImagePlaceholder heightClass="h-36" />
                )}
              </View>

              <View className="pt-2 pb-1 px-1">
                <Text className="text-xs font-black text-black tracking-tight" numberOfLines={1}>
                  {item.ProductName?.toUpperCase()}
                </Text>

                <View className="flex-row justify-between items-end mt-2">
                  <View className="flex-1">
                    {hasDiscount ? (
                      <>
                        <Text className="text-sm font-black text-black">
                          ₦{Number(item.OnlineRate).toLocaleString()}
                        </Text>
                        <Text className="text-[10px] font-bold text-red-600 line-through mt-0.5">
                          ₦{Number(item.SellingPrice).toLocaleString()}
                        </Text>
                      </>
                    ) : (
                      <Text className="text-sm font-black text-black">
                        ₦{Number(item.SellingPrice).toLocaleString()}
                      </Text>
                    )}
                  </View>

                  <TouchableOpacity
                       onPress={() => router.push({ 
                          pathname: "(drawer)/single-product",
                          params: { id: item.ID } 
                        })}
                    className="bg-black px-3 py-1.5 rounded-lg ml-1"
                  >
                    <Text className="text-[10px] font-bold text-white tracking-wider">ADD</Text>
                  </TouchableOpacity>
                </View>
              </View>
            </View>
          );
        }}
      />
    </View>
  );
}

this is how i handle my product on laravel <?php

namespace App\Livewire\Pages\Home;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductsSection extends Component
{
    public array $products = [];
    public int $page = 1;
    public bool $hasMore = true;
    public bool $isLoading = false;
    public bool $isMoreLoading = false;
    public bool $networkError = false;

    public function mount()
    {
        $this->fetchProducts(1);
    }

    public function fetchProducts(int $pageNumber = 1)
    {
        if ($pageNumber === 1) {
            $this->isLoading = true;
        } else {
            $this->isMoreLoading = true;
        }

        $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products", [
                'page'  => $pageNumber,
                'limit' => 20,
            ]);

            if ($response->successful() && $response->json('Success')) {
                $newData = $response->json('Data') ?? [];

                if (count($newData) < 20) {
                    $this->hasMore = false;
                }

                if ($pageNumber === 1) {
                    $this->products = $newData;
                } else {
                    $this->products = array_merge($this->products, $newData);
                }

                $this->page = $pageNumber;
            } else {
                if ($pageNumber === 1) {
                    $this->products = [];
                }
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching products: ' . $th->getMessage());
            $this->networkError = true;
            if ($pageNumber === 1) {
                $this->products = [];
            }
        } finally {
            $this->isLoading = false;
            $this->isMoreLoading = false;
        }
    }

    public function loadMore()
    {
        if ($this->hasMore && !$this->isMoreLoading && !$this->isLoading) {
            $this->fetchProducts($this->page + 1);
        }
    }

    public function render()
    {
        return view('livewire.pages.home.products-section');
    }
} 
  <section class="bg-[#f8f9fa] py-12" id="shop">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      
      <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
        Our Products
      </h2>

      <!-- 1. INITIAL LOADING STATE (SKELETON GRID) -->
      @if($isLoading && $page === 1)
      <x-skeleton-loading/>
        {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @for ($i = 0; $i < 8; $i++)
            <div>
              <div class="relative bg-white rounded-[10px] overflow-hidden p-3 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] animate-pulse">
                <!-- White Shimmer Wave Overlay -->
                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-10 pointer-events-none"></div>

                <!-- Image Placeholder -->
                <div class="w-full aspect-square bg-gray-200 rounded-md mb-3"></div>

                <!-- Title Line Skeleton -->
                <div class="h-4 sm:h-5 bg-gray-200 rounded w-3/4 mx-auto mt-3 mb-2"></div>

                <!-- Price Line Skeleton -->
                <div class="h-5 sm:h-6 bg-gray-200 rounded w-1/2 mx-auto mb-2"></div>

                <!-- Button Placeholder Skeleton -->
                <div class="h-9 bg-gray-200 rounded w-24 mx-auto mt-2.5"></div>
              </div>
            </div>
          @endfor
        </div> --}}

      <!-- 2. NETWORK ERROR STATE -->
      @elseif($networkError && count($products) === 0)
      <x-fetch-error/>
        {{-- <div class="bg-white rounded-[10px] p-8 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] max-w-md mx-auto my-6 border border-red-100">
          <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h12a4 4 0 001-7.9 5 5 0 00-9.9-1.2A4.5 4.5 0 003 15z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-1">Failed to load products</h3>
          <p class="text-xs sm:text-sm text-gray-500 mb-5">We couldn't reach the server. Please check your internet connection.</p>
          <button 
            wire:click="fetchProducts(1)" 
            class="bg-black hover:bg-gray-800 text-white border-none py-2 px-6 rounded-full font-bold text-xs tracking-wider transition-all duration-300 cursor-pointer uppercase shadow-md active:scale-95"
          >
            Retry
          </button>
        </div> --}}

      <!-- 3. EMPTY PRODUCT STATE -->
      @elseif(count($products) === 0)
        <x-empty-section-state heightClass="h-44" message="No fresh batch items or our products discovered." />
      <!-- 4. PRODUCT GRID -->
      @else
        <div id="append-featured-product" class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach($products as $product)
            @php
              $sellingPrice = (float)($product['SellingPrice'] ?? 0);
              $onlineRate   = isset($product['OnlineRate']) ? (float)$product['OnlineRate'] : null;
              $hasDiscount  = $onlineRate && $onlineRate < $sellingPrice;
            @endphp

            <div data-aos="fade-up" data-aos-duration="1000">
              <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                
                <!-- Image or Fallback Component -->
                <div class="relative overflow-hidden aspect-square">
                  @if(!empty($product['SmallImage']))
                    <img 
                      src="{{ $product['SmallImage'] }}" 
                      alt="{{ $product['ProductName'] ?? 'Product' }}" 
                      class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                    />
                  @else
                    <x-no-image-uploaded heightClass="aspect-square" />
                  @endif
                </div>

                <!-- Product Name -->
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  {{ $product['ProductName'] ?? 'Product Name' }}
                </div>

                <!-- Pricing Section with Discount Logic -->
                <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                  @if($hasDiscount)
                    <span class="text-sm sm:text-lg font-black">&#8358;{{ number_format($onlineRate) }}</span>
                    <span class="text-xs sm:text-sm text-red-600 line-through font-semibold">&#8358;{{ number_format($sellingPrice) }}</span>
                  @else
                    <span class="text-lg sm:text-xl">&#8358;</span>
                    <span>{{ number_format($sellingPrice) }}</span>
                  @endif
                </div>

                <!-- Action Button -->
                <a href="{{ route('single-product', ['id' => $product['ID'] ?? null]) }}">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
                </a>

              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

  <!-- 5. DYNAMIC LOAD MORE BUTTON SECTION -->
  @if($hasMore && count($products) > 0)
    <section>
        <div id="Featured-load-More-Btn" class="text-center mt-2 px-4 mb-8">
            <button 
            wire:click="loadMore"
            wire:loading.attr="disabled"
            class="bg-black hover:bg-gray-800 text-white border-none font-bold py-3 px-6 rounded shadow-md w-full min-[701px]:w-[40%] transition-all duration-200 cursor-pointer uppercase tracking-wider text-sm inline-flex items-center justify-center gap-2"
            >
            <!-- Loading Spinner Icon -->
            <svg 
                wire:loading 
                wire:target="loadMore" 
                class="animate-spin h-4 w-4 text-white" 
                fill="none" 
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            <!-- Default Text State -->
            <span wire:loading.remove wire:target="loadMore">
                Load More
            </span>

            <!-- Active Loading Text State -->
            <span wire:loading wire:target="loadMore">
                Fetching Products...
            </span>
            </button>
        </div>
    </section>
  @endifpls can u help me work on this     <!-- Our Featured Section -->
    <section class="bg-[#f8f9fa] py-12" id="shop">
      <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
          Featured Products
        </h2>

        <!-- Horizontal Scrollable Container -->
        <div 
          id="append-featured-product" 
          class="flex overflow-x-auto gap-4 pb-4 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100"
        >

          {{-- Card 1 Note: Very important --}}
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              
              {{-- @if(!empty($product->image)) --}}
                  {{-- Normal Image View --}}
                  {{-- <div class="relative overflow-hidden aspect-square">
                    <img 
                      src="{{ $product->image }}" 
                      alt="{{ $product->name }}" 
                      class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                    >
                  </div>
              @else --}}
                  {{-- Standalone Fallback Component --}}
                  <x-no-image-uploaded heightClass="aspect-square" />
              {{-- @endif --}}

              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                {{ $product->name ?? 'Luxury Leather Handbag' }}
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>{{ number_format($product->price ?? 25000) }}</span>
              </div>
              <a href="single.product.php?GetSingleProductId=1">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                  alt="Designer Men Sneakers" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Designer Men Sneakers
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>42,500</span>
              </div>
              <a href="single.product.php?GetSingleProductId=2">
                 <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 3 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=600&auto=format&fit=crop" 
                  alt="Classic Chronograph Watch" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Classic Chronograph Watch
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>18,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=3">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 4 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=600&auto=format&fit=crop" 
                  alt="Luxury Designer Sunglasses" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Luxury Designer Sunglasses
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>30,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=4">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 5 (Added) -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=600&auto=format&fit=crop" 
                  alt="Minimalist Running Shoes" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Minimalist Running Shoes
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>35,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=5">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 6 (Added) -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                  alt="Premium Tote Bag" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Premium Leather Tote
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>28,500</span>
              </div>
              <a href="single.product.php?GetSingleProductId=6">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section> and this namespace App\Livewire\Pages\Home;

use Livewire\Component;

class FeaturedSection extends Component
{
    public function render()
    {
        return view('livewire.pages.home.featured-section');
    }
}