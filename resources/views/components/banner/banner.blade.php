@if (Route::current()->getName() === 'top')
    <section class="banner block md:hidden min-h-0">
        <div class="h-full flex flex-col">
            <div class="text-content mobi-container w-full relative">
                <div class="text-lg xsm:text-3xl sm:text-5xl">
                    <span>KIMURA UNITY GROUP</span>
                </div>
                <div class=" mt-6 w-full">
                    <div class="flex flex-col text-sm xsm:text-lg sm:text-xl">
                        <span class="inline-block">キムラユニティーグループの</span>
                        <span class="inline-block">WEB予約ページへようこそ。</span>
                    </div>
                </div>
            </div>
            <div class="image-content w-full h-full min-h-40 flex">
                <img src="{{ Vite::asset('resources/img/top/top.png') }}" alt="タイトル"
                    class="mobi-polygon banner-aspect min-h-40">
            </div>
        </div>
    </section>
    <section class="banner hidden md:block mx-auto max-w-7xl">
        <div class="min-h-48 flex flex-row sm:max-h-72">
            <div class="text-content w-2/6 h-auto relative">
                <div class="text-container desktop-container">
                    <h1 class="text-base xsm:text-xl md:text-2xl lg:text-4xl sm:mb-6">
                        <span>KIMURA UNITY GROUP</span>
                    </h1>
                    <div class="w-[85%]">
                        <div class="block text-sm lg:text-lg mb-[1rem]">
                            <span class="inline-block">キムラユニティーグループの</span>
                            <span class="inline-block">WEB予約ページへようこそ。</span>
                        </div>
                    </div>
                    <div class="scroll-indicator inline-block">
                        <img src="{{ Vite::asset('resources/img/top/scroll.png') }}" alt="スクロール" id="scrollbar"
                            class="scroll w-4">
                    </div>
                </div>
            </div>
            <div class="image-content w-4/6 h-auto">
                <img src="{{ Vite::asset('resources/img/top/top.png') }}" alt="タイトル"
                    class="desktop-polygon banner-aspect w-full h-full">
            </div>
        </div>
    </section>
@endif
