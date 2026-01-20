<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public_assets/images/ban.png') }}" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap"
        rel="stylesheet" type="text/css" />
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('public_assets/css/tailwind.css') }}" type="text/css" />
    <!-- Select2 for any form selects -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $orgName ?? 'BAN-PDM' }} Provinsi Jawa Timur</title>
</head>

<body class="w-full min-h-screen font-lato antialiased">
    <!-- Document Wrapper -->
    <div id="wrapper" class="w-full clearfix">
        <!-- Header -->
        <header id="header" class="w-full fixed top-0 left-0 z-50 bg-transparent transition-all duration-300" data-sticky-class="bg-white shadow-md">
            <div class="container mx-auto px-4">
                <div id="header-row" class="flex items-center justify-between py-4 transition-all duration-300">
                    <!-- Logo -->
                    <div id="logo">
                        <a href="/" class="block">
                            <img id="logo-img" src="{{ asset('public_assets/images/ban.png') }}" alt="{{ $orgName ?? 'BAN-PDM' }} Logo" class="h-12 md:h-16 transition-all duration-300">
                        </a>
                    </div>
                    <div class="header-misc"></div>
                </div>
            </div>
        </header>

        <!-- Hero Section / Slider -->
        <section id="slider" class="relative w-full min-h-[60vh] md:min-h-screen flex items-center justify-center overflow-hidden">
            <div class="slider-inner relative w-full h-full">
                <div class="swiper-container swiper-parent relative w-full h-full">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide relative w-full min-h-[60vh] md:min-h-screen flex items-center justify-center text-white">
                            <div class="container mx-auto px-4 relative z-10">
                                <div class="text-center">
                                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 font-poppins" data-animate="fadeInUp">
                                        {!! $heroTitle !!}
                                    </h2>
                                    <p class="hidden sm:block text-lg md:text-xl max-w-4xl mx-auto font-lato" data-animate="fadeInUp" data-delay="3">
                                        {!! nl2br(e($heroDescription)) !!}
                                    </p>
                                </div>
                            </div>
                            <div class="video-wrap absolute inset-0 w-full h-full">
                                @if(isset($heroMedia) && $heroMedia)
                                    @if($heroMedia['type'] === 'video' && $heroMedia['url'])
                                        <!-- Video File -->
                                        <video id="slide-video" preload="auto" loop autoplay muted class="absolute inset-0 w-full h-full object-cover">
                                            <source src="{{ asset($heroMedia['url']) }}" type='video/webm' />
                                            <source src="{{ asset($heroMedia['url']) }}" type='video/mp4' />
                                        </video>
                                    @elseif($heroMedia['type'] === 'youtube' && $heroMedia['url'])
                                        <!-- YouTube Video -->
                                        @php
                                            // Extract YouTube video ID from URL
                                            $youtubeUrl = $heroMedia['url'];
                                            $videoId = null;
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $youtubeUrl, $matches)) {
                                                $videoId = $matches[1];
                                            }
                                        @endphp
                                        @if($videoId)
                                            <iframe id="youtube-video" 
                                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&loop=1&playlist={{ $videoId }}&mute=1&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1"
                                                    class="absolute inset-0 w-full h-full"
                                                    frameborder="0"
                                                    allow="autoplay; encrypted-media"
                                                    allowfullscreen></iframe>
                                        @endif
                                    @elseif($heroMedia['type'] === 'image' && $heroMedia['url'])
                                        <!-- Image Background -->
                                        <img src="{{ asset($heroMedia['url']) }}" 
                                             alt="Hero Background" 
                                             class="absolute inset-0 w-full h-full object-cover">
                                    @else
                                        <!-- Fallback: Default video -->
                                        <video id="slide-video" preload="auto" loop autoplay muted class="absolute inset-0 w-full h-full object-cover">
                                            <source src='' type='video/webm' />
                                            <source src='' type='video/mp4' />
                                        </video>
                                    @endif
                                @else
                                    <!-- Default: No hero media configured -->
                                    <video id="slide-video" preload="auto" loop autoplay muted class="absolute inset-0 w-full h-full object-cover">
                                        <source src='' type='video/webm' />
                                        <source src='' type='video/mp4' />
                                    </video>
                                @endif
                                <div class="video-overlay absolute inset-0 bg-dark-overlay"></div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-arrow-left absolute left-4 top-1/2 transform -translate-y-1/2 z-20 cursor-pointer text-white text-4xl hover:text-gray-300 transition-colors">
                        <i class="icon-angle-left">‹</i>
                    </div>
                    <div class="slider-arrow-right absolute right-4 top-1/2 transform -translate-y-1/2 z-20 cursor-pointer text-white text-4xl hover:text-gray-300 transition-colors">
                        <i class="icon-angle-right">›</i>
                    </div>
                </div>
                <a href="#content" data-scrollto="#content" data-offset="100"
                    class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 text-white text-4xl animate-bounce">
                    <i class="icon-angle-down">↓</i>
                </a>
            </div>
        </section>

        <!-- Welcome Section -->
        <section class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                    <div class="w-full md:w-1/3 flex justify-center">
                        <img data-animate="fadeInLeft" src="{{ $ketuaImage }}"
                            alt="Ketua {{ $orgName ?? 'BAN-PDM' }}" class="w-full max-w-sm rounded-lg shadow-lg">
                    </div>
                    <div class="w-full md:w-2/3 text-center md:text-left">
                        <div class="mb-6 pb-4 border-b-2 border-gray-300">
                            <h3 class="text-2xl md:text-3xl font-bold font-poppins text-gray-800">{!! $welcomeTitle !!}</h3>
                        </div>
                        <div class="space-y-4 text-gray-700 font-lato leading-relaxed">
                            {!! nl2br(e($welcomeMessage)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi Misi Section -->
        @if(!empty($visi) || !empty($misi))
        <section class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800 relative inline-block pb-4 border-b-2 border-gray-300">
                        Visi & Misi {{ $orgName ?? 'BAN-PDM' }} Provinsi Jawa Timur
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 max-w-6xl mx-auto">
                    @if(!empty($visi))
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-lg shadow-lg">
                        <div class="mb-6">
                            <h4 class="text-2xl md:text-3xl font-bold font-poppins text-blue-800 mb-4 flex items-center">
                                <span class="mr-3 text-4xl">👁️</span>
                                Visi
                            </h4>
                        </div>
                        <div class="text-gray-700 font-lato leading-relaxed text-lg">
                            {!! $visi !!}
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($misi))
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-lg shadow-lg">
                        <div class="mb-6">
                            <h4 class="text-2xl md:text-3xl font-bold font-poppins text-green-800 mb-4 flex items-center">
                                <span class="mr-3 text-4xl">🎯</span>
                                Misi
                            </h4>
                        </div>
                        <div class="text-gray-700 font-lato leading-relaxed text-lg">
                            {!! $misi !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        <!-- Recent Update Section -->
        <section id="content" class="py-16 md:py-24 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800 relative inline-block pb-4 border-b-2 border-gray-300">
                        Recent Update
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($recentUpdates as $update)
                        <div class="flip-card relative w-full h-64">
                            <div class="flip-card-front absolute inset-0 w-full h-full bg-cover bg-center rounded-lg shadow-lg"
                                style="background-image: url('{{ asset($update->gmb ?? $update->gmb1 ?? 'public_assets/images/ban.png') }}')">
                                <div class="flip-card-inner relative w-full h-full flex items-end">
                                    <div class="w-full bg-black bg-opacity-50 text-white p-4 rounded-b-lg">
                                        <h3 class="text-xl font-bold mb-2 font-poppins">{{ $update->judul ?? 'No Title' }}</h3>
                                        <span class="text-sm italic">{{ $update->created_at ? $update->created_at->format('Y-m-d') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                    <div class="text-center p-4">
                                        <p class="mb-4 text-white font-lato">{{ \Illuminate\Support\Str::limit(strip_tags($update->isi ?? ''), 100) }}</p>
                                        <button onclick="openBeritaModal({{ $update->id }})" class="inline-block px-4 py-2 border-2 border-white text-white rounded hover:bg-white hover:text-black transition-colors cursor-pointer">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">
                            <p>No recent updates available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Secretariat Section -->
        <section id="content" class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800 relative inline-block pb-4 border-b-2 border-gray-300">
                        SEKRETARIAT {{ $orgName ?? 'BAN-PDM' }} PROVINSI JAWA TIMUR
                    </h3>
                </div>

                <!-- Tab Navigation -->
                <div class="mb-8 border-b border-gray-200">
                    <nav class="flex flex-wrap justify-center -mb-px" role="tablist">
                        @if($staffByUnit['ketua_sekretaris']->count() > 0)
                            <button class="tab-button active px-6 py-3 text-sm font-medium text-gray-700 border-b-2 border-blue-600 hover:text-blue-600 transition-colors" 
                                    onclick="switchTab('ketua-sekretaris')" id="tab-ketua-sekretaris">
                                Ketua & Sekretaris
                            </button>
                        @endif
                        @if($staffByUnit['anggota']->count() > 0)
                            <button class="tab-button px-6 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-gray-300 transition-colors" 
                                    onclick="switchTab('anggota')" id="tab-anggota">
                                Anggota
                            </button>
                        @endif
                        @if($staffByUnit['kpkk']->count() > 0)
                            <button class="tab-button px-6 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-gray-300 transition-colors" 
                                    onclick="switchTab('kpkk')" id="tab-kpkk">
                                KPKK
                            </button>
                        @endif
                        @if($staffByUnit['staff_administrasi']->count() > 0)
                            <button class="tab-button px-6 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-gray-300 transition-colors" 
                                    onclick="switchTab('staff-administrasi')" id="tab-staff-administrasi">
                                Staff Administrasi
                            </button>
                        @endif
                        @if($staffByUnit['staff_keuangan']->count() > 0)
                            <button class="tab-button px-6 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-gray-300 transition-colors" 
                                    onclick="switchTab('staff-keuangan')" id="tab-staff-keuangan">
                                Staff Keuangan
                            </button>
                        @endif
                        @if($staffByUnit['staff_data_it']->count() > 0)
                            <button class="tab-button px-6 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-gray-300 transition-colors" 
                                    onclick="switchTab('staff-data-it')" id="tab-staff-data-it">
                                Staff Data & IT
                            </button>
                        @endif
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Tab 1: Ketua & Sekretaris -->
                    @if($staffByUnit['ketua_sekretaris']->count() > 0)
                        <div id="content-ketua-sekretaris" class="tab-pane active">
                            <div class="relative">
                                <button onclick="slideCarousel('ketua-sekretaris', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-ketua-sekretaris" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['ketua_sekretaris'] as $staff)
                                            @php
                                                $unitDisplay = $staff->unit === 'Ketua' ? 'KETUA' : 'SEKRETARIS';
                                            @endphp
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">{{ $unitDisplay }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('ketua-sekretaris', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Tab 2: Anggota -->
                    @if($staffByUnit['anggota']->count() > 0)
                        <div id="content-anggota" class="tab-pane hidden">
                            <div class="relative">
                                <button onclick="slideCarousel('anggota', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-anggota" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['anggota'] as $staff)
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">ANGGOTA</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('anggota', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Tab 3: KPKK -->
                    @if($staffByUnit['kpkk']->count() > 0)
                        <div id="content-kpkk" class="tab-pane hidden">
                            <div class="relative">
                                <button onclick="slideCarousel('kpkk', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-kpkk" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['kpkk'] as $staff)
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">KOORDINATOR PENGELOLA KEUANGAN DAN KEGIATAN</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('kpkk', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Tab 4: Staff Administrasi -->
                    @if($staffByUnit['staff_administrasi']->count() > 0)
                        <div id="content-staff-administrasi" class="tab-pane hidden">
                            <div class="relative">
                                <button onclick="slideCarousel('staff-administrasi', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-staff-administrasi" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['staff_administrasi'] as $staff)
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">STAF ADMINISTRASI</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('staff-administrasi', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Tab 5: Staff Keuangan -->
                    @if($staffByUnit['staff_keuangan']->count() > 0)
                        <div id="content-staff-keuangan" class="tab-pane hidden">
                            <div class="relative">
                                <button onclick="slideCarousel('staff-keuangan', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-staff-keuangan" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['staff_keuangan'] as $staff)
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">STAF KEUANGAN</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('staff-keuangan', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Tab 6: Staff Data & IT -->
                    @if($staffByUnit['staff_data_it']->count() > 0)
                        <div id="content-staff-data-it" class="tab-pane hidden">
                            <div class="relative">
                                <button onclick="slideCarousel('staff-data-it', -1)" class="carousel-prev absolute left-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="carousel-container overflow-hidden mx-12">
                                    <div id="carousel-staff-data-it" class="carousel-wrapper flex transition-transform duration-500 ease-in-out gap-6" style="transform: translateX(0px);">
                                        @foreach($staffByUnit['staff_data_it'] as $staff)
                                            <div class="carousel-slide flex-shrink-0" style="width: calc(25% - 18px); min-width: 250px;">
                                                <div class="flip-card relative w-full h-80">
                                                    <div class="flip-card-front absolute inset-0 w-full h-full bg-gray-800 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center text-white p-4">
                                                                <h3 class="text-xl font-bold mb-2 font-poppins">{{ $staff->nama }}</h3>
                                                                <span class="text-sm italic">IT dan Staf Pengelola Data</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-card-back absolute inset-0 w-full h-full bg-gray-700 rounded-lg shadow-lg">
                                                        <div class="flip-card-inner relative w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-4">
                                                                <div class="team-image mb-4">
                                                                    @if($staff->photo)
                                                                        <img data-animate="fadeInLeft" 
                                                                             src="{{ asset($staff->photo) }}" 
                                                                             alt="{{ $staff->nama }}" 
                                                                             class="w-32 h-32 rounded-full mx-auto object-cover">
                                                                    @else
                                                                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-600 flex items-center justify-center">
                                                                            <span class="text-white text-4xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <h4 class="text-white font-bold font-poppins">{{ $staff->nama }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="slideCarousel('staff-data-it', 1)" class="carousel-next absolute right-0 z-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:scale-110 flex items-center justify-center border-4 border-white" style="width: 60px; height: 60px; top: calc(50% - 80px);">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <style>
            .carousel-container {
                width: 100%;
                position: relative;
                overflow: hidden;
            }
            .carousel-wrapper {
                display: flex;
                will-change: transform;
                transition: transform 0.5s ease-in-out;
                flex-wrap: nowrap;
            }
            .carousel-slide {
                flex: 0 0 auto;
                width: calc(25% - 18px);
                min-width: 250px;
                margin-right: 0;
            }
            @media (max-width: 1024px) {
                .carousel-slide {
                    width: calc(33.333% - 16px) !important;
                    min-width: 200px !important;
                }
            }
            @media (max-width: 768px) {
                .carousel-slide {
                    width: calc(50% - 12px) !important;
                    min-width: 180px !important;
                }
            }
            @media (max-width: 640px) {
                .carousel-slide {
                    width: 100% !important;
                    min-width: 100% !important;
                }
            }
        </style>
        <script>
            // Carousel state for each tab
            const carouselState = {};
            const CARDS_PER_VIEW = 4; // Show 4 cards at a time

            function initCarousel(tabName) {
                const carousel = document.getElementById('carousel-' + tabName);
                if (carousel && !carouselState[tabName]) {
                    const totalSlides = carousel.children.length;
                    const maxIndex = Math.max(0, Math.ceil(totalSlides / CARDS_PER_VIEW) - 1);
                    
                    carouselState[tabName] = {
                        currentIndex: 0,
                        slideWidth: 0,
                        totalSlides: totalSlides,
                        maxIndex: maxIndex
                    };
                    
                    // Calculate slide width (width of 4 cards + gaps)
                    if (carousel.children.length > 0) {
                        const container = carousel.parentElement;
                        const containerWidth = container.offsetWidth;
                        const gap = parseInt(window.getComputedStyle(carousel).gap) || 24;
                        // Each card takes 25% minus gap
                        const cardWidth = (containerWidth - (gap * (CARDS_PER_VIEW - 1))) / CARDS_PER_VIEW;
                        // Calculate width of 4 cards including gaps
                        carouselState[tabName].slideWidth = (cardWidth * CARDS_PER_VIEW) + (gap * (CARDS_PER_VIEW - 1));
                    }
                }
            }

            function slideCarousel(tabName, direction) {
                initCarousel(tabName);
                const carousel = document.getElementById('carousel-' + tabName);
                if (!carousel || !carouselState[tabName]) return;

                const state = carouselState[tabName];
                
                // Calculate new index (move by 4 cards at a time)
                state.currentIndex += direction;
                
                // Boundary checks
                if (state.currentIndex < 0) {
                    state.currentIndex = 0;
                } else if (state.currentIndex > state.maxIndex) {
                    state.currentIndex = state.maxIndex;
                }

                // Calculate transform - move by 4 cards
                const translateX = -(state.currentIndex * state.slideWidth);
                carousel.style.transform = `translateX(${translateX}px)`;
            }

            function switchTab(tabName) {
                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                    pane.classList.remove('active');
                });

                // Remove active class from all buttons
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active', 'border-blue-600', 'text-blue-600');
                    btn.classList.add('text-gray-500', 'border-transparent');
                });

                // Show selected tab pane
                const selectedPane = document.getElementById('content-' + tabName);
                if (selectedPane) {
                    selectedPane.classList.remove('hidden');
                    selectedPane.classList.add('active');
                    // Initialize carousel for this tab
                    initCarousel(tabName);
                }

                // Add active class to selected button
                const selectedButton = document.getElementById('tab-' + tabName);
                if (selectedButton) {
                    selectedButton.classList.add('active', 'border-blue-600', 'text-blue-600');
                    selectedButton.classList.remove('text-gray-500', 'border-transparent');
                }
            }

            // Initialize carousels on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize active tab carousel
                const activeTab = document.querySelector('.tab-pane.active');
                if (activeTab) {
                    const tabId = activeTab.id.replace('content-', '');
                    initCarousel(tabId);
                }
            });
        </script>

        <!-- Mekanisme Akreditasi Section -->
        <section id="content" class="py-16 md:py-24 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800">MEKANISME AKREDITASI</h3>
                </div>
                <div class="flex justify-center">
                    <a href="#">
                        <img src="{{ $mekanismeImage }}" alt="Mekanisme Akreditasi" class="w-full max-w-4xl rounded-lg shadow-lg">
                    </a>
                </div>
            </div>
        </section>

        <!-- Hak dan Kewajiban Section -->
        <section id="content" class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800">HAK DAN KEWAJIBAN ANGGOTA {{ $orgName ?? 'BAN-PDM' }}</h3>
                </div>
                <div class="flex justify-center">
                    <a href="#">
                        <img height="120" src="{{ $hakKewajibanImage }}" alt="Hak dan Kewajiban" class="h-30 rounded-lg shadow-lg">
                    </a>
                </div>
            </div>
        </section>

        <!-- Gallery Foto Section -->
        <div class="container mx-auto px-4 py-16 md:py-24 bg-gray-50">
            <div class="text-center mb-12">
                <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800 mb-0">GALLERY FOTO</h3>
            </div>
            <div id="portfolio" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <h3 class="col-span-full text-center text-gray-600">Sek, ngenteni antek yahudi approve</h3>
                {{-- @foreach ($foto as $pic)
                    <article class="portfolio-item overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                        <div class="relative group">
                            <div class="portfolio-image">
                                <a href="portfolio-single.html">
                                    <img src="{{ $pic->path_gallery }}" alt="Gallery Image" class="w-full h-64 object-cover">
                                </a>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-opacity">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <h3 class="text-white font-semibold"><a href="foto1.html">Open Imagination</a></h3>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach --}}
            </div>
        </div>

        <!-- Gallery Video Section -->
        <div class="py-16 md:py-24 bg-white border-t border-gray-200">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold font-poppins text-gray-800 mb-0">GALLERY VIDEO</h3>
                </div>
                <div id="youtube" class="container mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- {{ dd($items) }}  --}}
                        @foreach ($items as $item)
                            <div class="entry bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                                <div class="p-2.5">
                                    <iframe width="100%" height="60"
                                        src="https://www.youtube.com/embed/{{ $item['id']['videoId'] }}"
                                        frameborder="0" allowfullscreen class="rounded">
                                    </iframe>
                                    <p class="text-center mt-2 text-sm text-gray-700 font-lato">{{ $item['snippet']['title'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer" class="bg-gray-900 text-gray-300 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    Copyrights &copy; 2022 {{ $orgName ?? 'BAN-PDM' }} Provinsi Jawa Timur by ir.teguh<br>
                </div>
                <div class="text-center md:text-right">
                    <i class="icon-envelope2">✉</i> infobapsmjatim@gmail.com <span class="mx-2">&middot;</span>
                    <i class="icon-headphones">📞</i> <a href="https://wa.me/6281334169405" class="hover:text-white transition-colors">0813-3416-9405</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScripts -->
    <script src="{{ asset('public_assets/assets2/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('public_assets/assets2/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <script src="{{ asset('public_assets/js/jquery.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/functions.js') }}"></script>
    
    <!-- Go To Top -->
    <div id="gotoTop" class="fixed bottom-8 right-8 bg-gray-800 text-white p-3 rounded-full cursor-pointer hover:bg-gray-700 transition-colors shadow-lg z-50 opacity-0 invisible transition-all duration-300">
        ↑
    </div>

    <script>
        // Scroll to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            const gotoTop = document.getElementById('gotoTop');
            
            // Show/hide scroll to top button
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    gotoTop.classList.remove('opacity-0', 'invisible');
                    gotoTop.classList.add('opacity-100', 'visible');
                } else {
                    gotoTop.classList.add('opacity-0', 'invisible');
                    gotoTop.classList.remove('opacity-100', 'visible');
                }
            });
            
            // Scroll to top on click
            gotoTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Sticky header functionality with reduced height on scroll
            const header = document.getElementById('header');
            const headerRow = document.getElementById('header-row');
            const logoImg = document.getElementById('logo-img');
            let lastScroll = 0;
            
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    header.classList.add('bg-white', 'shadow-md');
                    header.classList.remove('bg-transparent');
                    
                    // Reduce navbar height significantly (to ~30% of original)
                    headerRow.classList.remove('py-4');
                    headerRow.classList.add('py-1');
                    logoImg.classList.remove('h-12', 'md:h-16');
                    logoImg.classList.add('h-4', 'md:h-5');
                } else {
                    header.classList.remove('bg-white', 'shadow-md');
                    header.classList.add('bg-transparent');
                    
                    // Restore original navbar height
                    headerRow.classList.remove('py-1');
                    headerRow.classList.add('py-4');
                    logoImg.classList.remove('h-4', 'md:h-5');
                    logoImg.classList.add('h-12', 'md:h-16');
                }
                
                lastScroll = currentScroll;
            });
        });
    </script>

    <!-- Berita Detail Modal -->
    <div id="beritaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeBeritaModal()"></div>
        
        <!-- Modal container -->
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl w-full max-h-[90vh] flex flex-col">
                <!-- Close button -->
                <button onclick="closeBeritaModal()" class="absolute top-4 right-4 z-20 bg-white rounded-full p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <!-- Modal content -->
                <div class="bg-white flex-1 flex flex-col overflow-hidden">
                    <!-- Content section -->
                    <div class="overflow-y-auto flex-1" style="max-height: calc(90vh - 2rem); -webkit-overflow-scrolling: touch;">
                        <!-- Loading state -->
                        <div id="beritaModalLoading" class="text-center py-12">
                            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                            <p class="mt-4 text-gray-600">Loading...</p>
                        </div>
                        
                        <!-- Blog-style content -->
                        <article id="beritaModalContent" class="hidden">
                            <!-- Header section -->
                            <header class="px-6 md:px-12 pt-8 md:pt-12 pb-6">
                                <h1 id="beritaModalTitle" class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 font-poppins mb-4 leading-tight"></h1>
                                <div class="flex items-center gap-4 text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span id="beritaModalDate" class="text-sm md:text-base font-lato"></span>
                                </div>
                            </header>
                            
                            <!-- Featured image -->
                            <div id="beritaModalImageContainer" class="w-full mb-8 hidden flex justify-center px-6 md:px-12">
                                <img id="beritaModalImage" src="" alt="" class="max-w-3xl w-full h-auto object-cover rounded-lg shadow-lg">
                            </div>
                            
                            <!-- Article content - isi berita -->
                            <div id="beritaModalBody" class="px-6 md:px-12 pb-8 md:pb-12">
                                <div id="beritaModalIsi" class="prose prose-lg prose-blue max-w-none text-gray-700 font-lato leading-relaxed berita-content">
                                    <!-- Content will be loaded here -->
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Suppress CORS errors from ad blockers and privacy extensions
        (function() {
            const originalError = console.error;
            console.error = function(...args) {
                const message = args.join(' ');
                if (message.includes('doubleclick') || 
                    message.includes('googleads') || 
                    message.includes('CORS request did not succeed') ||
                    message.includes('Failed to load resource')) {
                    // Silently ignore ad blocker related errors
                    return;
                }
                originalError.apply(console, args);
            };
        })();

        // Suppress unhandled promise rejections from blocked scripts
        window.addEventListener('unhandledrejection', function(event) {
            const reason = event.reason?.message || event.reason?.toString() || '';
            if (reason.includes('doubleclick') || reason.includes('googleads') || reason.includes('CORS')) {
                event.preventDefault();
            }
        });

        function openBeritaModal(beritaId) {
            const modal = document.getElementById('beritaModal');
            const loading = document.getElementById('beritaModalLoading');
            const content = document.getElementById('beritaModalContent');
            const imageContainer = document.getElementById('beritaModalImageContainer');
            const image = document.getElementById('beritaModalImage');
            const title = document.getElementById('beritaModalTitle');
            const date = document.getElementById('beritaModalDate');
            const body = document.getElementById('beritaModalBody');
            
            // Show modal and loading
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loading.classList.remove('hidden');
            content.classList.add('hidden');
            
            // Reset content
            title.textContent = '';
            date.textContent = '';
            const isiContent = document.getElementById('beritaModalIsi');
            if (isiContent) {
                isiContent.innerHTML = '';
            }
            imageContainer.classList.add('hidden');
            
            // Fetch berita details
            fetch(`/berita/${beritaId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to load berita');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Berita data received:', data); // Debug log
                    
                    // Update title and date
                    title.textContent = data.judul || 'Berita Detail';
                    date.textContent = data.created_at ? `Published on ${data.created_at}` : '';
                    
                    // Update image - show if available (check both gmb and gmb1), with fallback
                    const imageUrl = data.gmb || data.gmb1;
                    const fallbackImage = '{{ asset("public_assets/images/ban.png") }}';
                    const finalImageUrl = imageUrl || fallbackImage;
                    
                    console.log('Image URL:', imageUrl); // Debug log
                    console.log('Final Image URL:', finalImageUrl); // Debug log
                    
                    // Always show image container (either with image or fallback)
                    image.src = finalImageUrl;
                    image.alt = data.judul || 'Berita Image';
                    image.onload = function() {
                        console.log('Image loaded successfully:', finalImageUrl);
                        imageContainer.classList.remove('hidden');
                    };
                    image.onerror = function() {
                        console.error('Image failed to load:', finalImageUrl);
                        // Try fallback if original failed and wasn't already fallback
                        if (imageUrl && finalImageUrl !== fallbackImage) {
                            image.src = fallbackImage;
                        } else {
                            // If fallback also fails, hide the container
                            imageContainer.classList.add('hidden');
                        }
                    };
                    // Show container immediately
                    imageContainer.classList.remove('hidden');
                    
                    // Update content - check if isi exists and is not empty
                    const isiContent = document.getElementById('beritaModalIsi');
                    if (data.isi && data.isi.trim() !== '') {
                        isiContent.innerHTML = data.isi;
                    } else {
                        isiContent.innerHTML = '<p class="text-gray-500 text-center italic">No content available for this berita.</p>';
                    }
                    
                    // Hide loading, show content
                    loading.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error loading berita:', error);
                    loading.classList.add('hidden');
                    const isiContent = document.getElementById('beritaModalIsi');
                    if (isiContent) {
                        isiContent.innerHTML = '<p class="text-red-600 text-center">Failed to load berita details. Please try again.</p>';
                    }
                    content.classList.remove('hidden');
                });
        }
        
        function closeBeritaModal() {
            const modal = document.getElementById('beritaModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeBeritaModal();
            }
        });
    </script>

    <style>
        /* Blog/News style enhancements */
        .berita-content.prose {
            font-size: 1.125rem;
            line-height: 1.75;
        }
        
        .berita-content.prose p {
            margin-bottom: 1.25em;
            color: #374151;
        }
        
        .berita-content.prose h1,
        .berita-content.prose h2,
        .berita-content.prose h3,
        .berita-content.prose h4 {
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 1em;
            color: #111827;
            font-family: 'Poppins', sans-serif;
        }
        
        .berita-content.prose h2 {
            font-size: 1.875rem;
        }
        
        .berita-content.prose h3 {
            font-size: 1.5rem;
        }
        
        .berita-content.prose img {
            border-radius: 0.5rem;
            margin: 2em auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }
        
        /* Limit featured image size */
        #beritaModalImage {
            max-width: 800px;
            max-height: 500px;
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        
        /* Limit images in content */
        .berita-content.prose img {
            max-width: 700px;
            width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        .berita-content.prose ul,
        .berita-content.prose ol {
            margin: 1.5em 0;
            padding-left: 1.5em;
        }
        
        .berita-content.prose li {
            margin: 0.5em 0;
        }
        
        .berita-content.prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1.5em;
            margin: 2em 0;
            font-style: italic;
            color: #4b5563;
        }
        
        .berita-content.prose a {
            color: #3b82f6;
            text-decoration: underline;
        }
        
        .berita-content.prose a:hover {
            color: #2563eb;
        }
        
        .berita-content.prose strong {
            font-weight: 600;
            color: #111827;
        }
        
        .berita-content.prose code {
            background-color: #f3f4f6;
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }
        
        .berita-content.prose pre {
            background-color: #1f2937;
            color: #f9fafb;
            padding: 1.5em;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 2em 0;
        }
        
        .berita-content.prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 2em 0;
        }
        
        .berita-content.prose th,
        .berita-content.prose td {
            border: 1px solid #e5e7eb;
            padding: 0.75em;
            text-align: left;
        }
        
        .berita-content.prose th {
            background-color: #f9fafb;
            font-weight: 600;
        }
    </style>
</body>

</html>
