<?php
$menu_header = getMenus('menu-header');
?>
<header id="header" class="page-header z-50 transition-all duration-1000 ease-in-out w-full">
    <div class="z-20">
        <div class="bg-color_primary z-20" id="header-black">
            <div class="container mx-auto px-[15px]">
                <div class="flex py-2 sm:px-0 items-center justify-between mx-auto">
                    <div class="text-white flex items-center gap-x-12">
                        <a href="{{ url('/') }}" class="logo">
                            <img alt="{{ $fcSystem['homepage_brandname'] }}" class="cursor-pointer object-cover"
                                src="{{ asset($fcSystem['homepage_logo']) }}" style="color: transparent;">
                        </a>
                        @if (isset($menu_header))
                            <!-- Menu -->
                            <nav class="flex justify-center md:block d-none" id="mmenu">
                                <ul class="flex flex-wrap items-center font-medium text-f16">
                                    @foreach ($menu_header->menu_items as $item)
                                        <li
                                            class="p-4 relative @if (isset($item->children) && count($item->children)) has-children flex items-center space-x-1 group @endif">
                                            <a class="" href="{{ url($item->slug) }}">{{ $item->title }}</a>
                                            @if (isset($item->children) && count($item->children))
                                                <button class="shrink-0 p-1" :aria-expanded="open"
                                                    @click.prevent="open = !open">
                                                    <span class="sr-only">Show submenu for "Flyout Menu"</span>
                                                    <svg class="w-3 h-3 fill-slate-500" xmlns="http://www.w3.org/2000/svg"
                                                        width="12" height="12">
                                                        <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                                                    </svg>
                                                </button>
                                                <!-- 2nd level menu -->
                                                <ul
                                                    class="submenu origin-top-right md:absolute top-full md:left-1/2 md:-translate-x-1/2 md:min-w-[240px] md:bg-white md:border border-slate-200 p-2 rounded-lg md:shadow-xl md:opacity-0 md:invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible md:group-hover:translate-y-2">
                                                    @foreach ($item->children as $child)
                                                        <li>
                                                            <a class="text-slate-800 hover:bg-slate-50 flex items-center p-2"
                                                                href="{{ url($child->slug) }}">
                                                                <span class="whitespace-nowrap">{{ $child->title }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                            <!-- End: Menu -->
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-x-4">
                            <div class="menuMobile" style="display: none">
                                <div>
                                    <a href="javascript:void(0)" id="menu-open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-menu  cursor-pointer text-white">
                                            <line x1="4" x2="20" y1="12" y2="12"></line>
                                            <line x1="4" x2="20" y1="6" y2="6"></line>
                                            <line x1="4" x2="20" y1="18" y2="18"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</header>

<style>
    .page-header.is-sticky {
        position: fixed;
        box-shadow: 0 5px 16px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        animation: slideDown 0.35s ease-out;
    }

    .page-header.is-sticky img {
        max-width: 80%;
    }

    .page-header.is-sticky button {
        font-size: 14px;
        padding: 7px 10px;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }

    /* FOOTER STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .page-footer {
        position: fixed;
        right: 0;
        bottom: 50px;
        display: flex;
        align-items: center;
        padding: 5px;
        z-index: 1;
        background: white;
    }

    .page-footer a {
        display: flex;
        margin-left: 4px;
    }
</style>

@push('javascript')
    <script>
        const header = document.getElementById("header");
        const toggleClass = "is-sticky";

        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 150) {
                header.classList.add(toggleClass);
            } else {
                header.classList.remove(toggleClass);
            }
        });
    </script>
@endpush
