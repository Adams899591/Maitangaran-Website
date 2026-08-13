did u see this <div>

  <section class="bg-[#f8f9fa] py-12" id="shop">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      
      <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
        Our Products
      </h2>

      <!-- 1. INITIAL LOADING STATE (SKELETON GRID) -->
      @if($isLoading && $page === 1)
      <x-skeleton-loading/>

      <!-- 2. NETWORK ERROR STATE -->
      @elseif($networkError && count($products) === 0)
      <x-fetch-error retry-action="fetchProducts" />

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
  @endif


</div>  if this is how i handle the mobile import React, { useEffect, useState, useRef } from 'react';
import { 
  View, 
  Text, 
  Image, 
  TouchableOpacity, 
  Dimensions, 
  ActivityIndicator, 
  Animated 
} from 'react-native';
import { useRouter } from 'expo-router';
import axios from 'axios';
import { Ionicons } from '@expo/vector-icons';

const { width } = Dimensions.get('window');

export default function OurProducts({ EmptySectionState, ImagePlaceholder }) {
  const router = useRouter();
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [loadingMore, setLoadingMore] = useState(false);
  const [networkError, setNetworkError] = useState(false);
  
  // Pagination State
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(true);

  // Animation values
  const scaleAnim = useRef(new Animated.Value(1)).current;
  const pulseAnim = useRef(new Animated.Value(1)).current;

  const cardWidth = (width - 44) / 2;

  // Start continuous pulse animation while loading more
  useEffect(() => {
    let loop;
    if (loadingMore) {
      loop = Animated.loop(
        Animated.sequence([
          Animated.timing(pulseAnim, {
            toValue: 0.95,
            duration: 500,
            useNativeDriver: true,
          }),
          Animated.timing(pulseAnim, {
            toValue: 1,
            duration: 500,
            useNativeDriver: true,
          }),
        ])
      );
      loop.start();
    } else {
      pulseAnim.setValue(1);
    }
    return () => loop?.stop();
  }, [loadingMore]);

  // Press animation handler
  const animatePress = (toValue) => {
    Animated.spring(scaleAnim, {
      toValue,
      friction: 4,
      tension: 100,
      useNativeDriver: true,
    }).start();
  };

  const fetchOurProducts = async (pageNumber = 1) => {
    if (pageNumber === 1) {
      setLoading(true);
    } else {
      setLoadingMore(true);
    }

    setNetworkError(false);

    try {
      const response = await axios.get(
        `${process.env.EXPO_PUBLIC_API_URL}/products?page=${pageNumber}&limit=20`, 
        {
          headers: {
            'Content-Type': 'application/json',
            'X-Api-Key': process.env.EXPO_PUBLIC_API_KEY,
          },
        }
      );

      const res = response.data;

      if (res && res.Success && Array.isArray(res.Data)) {
        const newProducts = res.Data;

        if (newProducts.length < 20) {
          setHasMore(false);
        }

        setProducts(prev => (pageNumber === 1 ? newProducts : [...prev, ...newProducts]));
        setPage(pageNumber);
      } else {
        if (pageNumber === 1) setProducts([]);
        setHasMore(false);
      }
    } catch (error) {
      console.log("Error fetching products:", error);
      setNetworkError(true);
      if (pageNumber === 1) setProducts([]);
    } finally {
      setLoading(false);
      setLoadingMore(false);
    }
  };

  const handleLoadMore = () => {
    if (hasMore && !loadingMore && !loading) {
      fetchOurProducts(page + 1);
    }
  };

  useEffect(() => {
    fetchOurProducts(1);
  }, []);

  if (loading && page === 1) {
    return (
      <View className="mt-8 h-44 items-center justify-center">
        <ActivityIndicator size="large" color="#000" />
      </View>
    );
  }

  if (networkError && products.length === 0) {
    return (
      <View className="mt-8 mx-4 bg-red-50 border border-red-100 rounded-2xl items-center justify-center p-6 h-44">
        <Ionicons name="cloud-offline-outline" size={26} color="#EF4444" />
        <Text className="text-gray-900 text-xs font-bold mt-2 text-center">
          Failed to load products
        </Text>
        <TouchableOpacity 
          onPress={() => fetchOurProducts(1)}
          className="mt-3 bg-black px-4 py-1.5 rounded-full"
        >
          <Text className="text-white text-[10px] font-bold tracking-wider">RETRY</Text>
        </TouchableOpacity>
      </View>
    );
  }

  if (products.length === 0) {
    return <EmptySectionState heightClass="h-44" message="No fresh batch items or our products discovered." />;
  }

  return (
    <View className="mt-8 px-4">
      <View className="flex-row justify-between items-center mb-4">
        <Text className="text-lg font-black tracking-tight text-black">Our Products</Text>
        <TouchableOpacity>
          <Text className="text-xs font-bold text-gray-500 tracking-wider">BROWSE ALL</Text>
        </TouchableOpacity>
      </View>

      {/* Grid container */}
      <View className="flex-row flex-wrap justify-between">
        {products.map((product) => {
          const hasDiscount = product.OnlineRate && Number(product.OnlineRate) < Number(product.SellingPrice);

          return (
            <View 
              key={product.ID} 
              style={{ width: cardWidth }} 
              className="bg-white mb-4 border border-gray-100 rounded-2xl overflow-hidden p-2"
            >
              {/* Image Section */}
              <View className="relative bg-gray-50 rounded-xl overflow-hidden">
                {product.SmallImage ? (
                  <Image source={{ uri: product.SmallImage }} className="w-full h-44 object-cover" />
                ) : (
                  <ImagePlaceholder heightClass="h-44" />
                )}
              </View>

              {/* Text Meta Content details */}
              <View className="pt-2 px-1">
                <Text className="text-xs font-bold text-black tracking-tight" numberOfLines={1}>
                  {product.ProductName}
                </Text>
                
                <View className="flex-row items-center justify-between mt-2">
                  <View className="flex-1">
                    {hasDiscount ? (
                      <>
                        <Text className="text-sm font-black text-black">
                          ₦{Number(product.OnlineRate).toLocaleString()}
                        </Text>
                        <Text className="text-[10px] font-bold text-red-600 line-through mt-0.5">
                          ₦{Number(product.SellingPrice).toLocaleString()}
                        </Text>
                      </>
                    ) : (
                      <Text className="text-sm font-black text-black">
                        ₦{Number(product.SellingPrice).toLocaleString()}
                      </Text>
                    )}
                  </View>

                  <TouchableOpacity 
                    onPress={() => router.push({ 
                      pathname: "(drawer)/single-product",
                      params: { id: product.ID }
                    })}
                    className="bg-black px-3 py-1.5 rounded-lg ml-1"
                  >
                    <Text className="text-[10px] font-bold text-white tracking-wider">ADD</Text>
                  </TouchableOpacity>
                </View>
              </View>
            </View>
          );
        })}
      </View>

      {/* FANCY ANIMATED LOAD MORE BUTTON */}
      {hasMore && (
        <View className="mt-2 mb-8 items-center justify-center">
          <Animated.View 
            style={{ 
              transform: [{ scale: loadingMore ? pulseAnim : scaleAnim }] 
            }}
          >
            <TouchableOpacity 
              activeOpacity={0.9}
              onPressIn={() => animatePress(0.94)}
              onPressOut={() => animatePress(1)}
              onPress={handleLoadMore}
              disabled={loadingMore}
              className="bg-black flex-row items-center justify-center px-7 py-3 rounded-2xl shadow-md"
              style={{
                shadowColor: '#000',
                shadowOffset: { width: 0, height: 4 },
                shadowOpacity: 0.15,
                shadowRadius: 8,
                elevation: 4,
              }}
            >
              {loadingMore ? (
                <>
                  <ActivityIndicator size="small" color="#FFFFFF" className="mr-2" />
                  <Text className="text-xs font-black text-white tracking-widest uppercase">
                    Fetching Products...
                  </Text>
                </>
              ) : (
                <>
                  <Text className="text-xs font-black text-white tracking-widest uppercase mr-2">
                    Discover More
                  </Text>
                  <Ionicons name="chevron-down-circle-outline" size={16} color="#FFFFFF" />
                </>
              )}
            </TouchableOpacity>
          </Animated.View>
        </View>
      )}
    </View>
  );
} can u pls help me work on this <?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Shop extends Component
{
    public function render()
    {
        return view('livewire.pages.shop')->layout("layouts.pages.app");
    }
} and this 
<div>
  <x-skeleton-loading-shop/>
  <div class="max-w-7xl mx-auto px-4 py-8 relative">

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

      <!-- ==================== SIDEBAR FILTER ==================== -->
      <div class="md:col-span-3">
        <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] mb-6">
          <h5 class="text-lg font-bold text-gray-900 mb-4">Filter Products</h5>

          <form wire:submit.prevent="searchCategory">
            <h6 class="font-bold text-gray-800 text-sm mb-2">Category</h6>

            <!-- NEW: Category Search Input with Interactive Black Button & White Icon -->
            <div class="relative mb-3 flex items-center">
              <input 
                type="text" 
                wire:model.defer="categorySearch"
                placeholder="Search categories..." 
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block pl-3 pr-11 py-2 outline-none transition-all"
              />
              
              <!-- Black Button Wrapper on the Right -->
              <button 
                type="button" 
                wire:click="filterCategories"
                wire:loading.attr="disabled"
                class="absolute right-1 top-1 bottom-1 bg-black hover:bg-gray-800 disabled:opacity-75 text-white px-2.5 rounded-md flex items-center justify-center transition-colors cursor-pointer"
                title="Search Categories"
              >
                <!-- Default White Search Icon -->
                <svg wire:loading.remove wire:target="filterCategories" class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                </svg>

                <!-- Loading White Spinner (When Clicked) -->
                <svg wire:loading wire:target="filterCategories" class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </button>
            </div>

            <!-- Slim Scrollable Container for Categories -->
            <div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Shoe" name="category" wire:model="category" class="accent-black" /> Shoes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Pullover" name="category" wire:model="category" class="accent-black" /> Pullover
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Watches" name="category" wire:model="category" class="accent-black" /> Watches
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Cloth" name="category" wire:model="category" class="accent-black" /> Cloths
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Bag" name="category" wire:model="category" class="accent-black" /> Bags
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Jewelry" name="category" wire:model="category" class="accent-black" /> Jewelry
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Electronics" name="category" wire:model="category" class="accent-black" /> Electronics
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Sunglasses" name="category" wire:model="category" class="accent-black" /> Sunglasses
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Perfumes" name="category" wire:model="category" class="accent-black" /> Perfumes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Belts" name="category" wire:model="category" class="accent-black" /> Belts
              </label>
            </div>

            <h6 class="font-bold text-gray-800 text-sm mt-3 mb-2">Price</h6>
            <input 
              type="range" 
              name="rangePrice" 
              wire:model.defer="rangePrice"
              class="w-full accent-black cursor-pointer" 
              id="priceRange" 
              min="2000" 
              max="20000" 
              value="9000" 
              oninput="updatePriceDisplay()" 
            />
            
            <div class="flex justify-between text-xs text-gray-500 mt-1">
              <span>&#8358;2,000</span>
              <span id="priceValue" class="font-bold text-gray-800">&#8358;9,000</span>
              <span>&#8358;20,000</span>
            </div>

            <!-- Main Search Button -->
            <button 
              type="submit" 
              wire:loading.attr="disabled"
              class="w-full mt-5 bg-black hover:bg-gray-800 disabled:opacity-75 text-white font-semibold py-2.5 px-4 rounded-md transition-colors duration-300 text-sm shadow-sm cursor-pointer flex items-center justify-center gap-2"
            >
              <svg wire:loading wire:target="searchCategory" class="animate-spin h-4 w-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>

              <span wire:loading.remove wire:target="searchCategory">Search</span>
              <span wire:loading wire:target="searchCategory">Searching...</span>
            </button>
          </form>
        </div>
      </div>


      <!-- ==================== MAIN PRODUCTS SECTION ==================== -->
      <div class="md:col-span-9">
        <h4 class="text-2xl font-bold text-gray-900 mb-1">Our Products</h4>
        <p class="text-sm font-semibold text-gray-600 mb-6">Here you can check out our products</p>

        <!-- Products Grid -->
        <div id="SearchProductsinput" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

          <!-- CARD 1: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                    alt="Designer Men Sneakers" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Designer Men Sneakers
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>42,500</span>
                </div>
              </div>

              <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 2: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Leather Smart Watch
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>18,000</span>
                </div>
              </div>

               <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 3: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                    alt="Luxury Leather Handbag" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Luxury Leather Handbag
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>25,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=3" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- CARD 4: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Cotton Pullover Hoodie
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>12,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=4" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>

        <!-- Pagination Container -->
        <div class="flex justify-center mt-8">
          <ul id="pagination-container" class="inline-flex gap-1"></ul>
        </div>

      </div>

    </div>
  </div>

  <!-- Custom CSS for a clean scrollbar on the category list -->
  <style>
    .custom-scrollbar::-webkit-scrollbar {
      width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #000;
    }
  </style>

  <!-- JavaScript for Sidebar Price Display -->
  <script>
    function updatePriceDisplay() {
      const slider = document.getElementById('priceRange');
      const display = document.getElementById('priceValue');
      display.textContent = `₦${parseInt(slider.value).toLocaleString()}`;
    }
  </script>

   
</div> OK so please I would like you to understand something before you start so The thing is that you know that this thing now is a website you understand me so we don't need to add is loading simply because it is a shop page So what I want you to do for me now is that what I want you to do for me now that you help me to design it with the reactivity you already know what it is bringing So what I just want now is for you to help me to do help me to handle it but this time like it will be coming in 20 products that's how it is designed So what we should do now is that on the on the response and we should put we should put pagination that shows that shows only four so the other 20 now should be handled by our code in navigating the user so once that user navigates to the last 20 then we make another API call for the winsey i don't know if you get what i'm trying to say why leve the cartegoey section untoch for now 