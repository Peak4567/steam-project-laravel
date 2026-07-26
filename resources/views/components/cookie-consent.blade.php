@if(($globalSettings['cookie_consent_enabled'] ?? '1') == '1')
<div
    x-data="{ show: false }"
    x-init="show = !localStorage.getItem('cookie_consent_accepted')"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    style="display: none;"
    class="fixed bottom-4 right-4 left-4 sm:left-auto z-[9999] sm:w-96 bg-[#222222] text-white rounded-2xl shadow-2xl border border-white/10 p-5 font-mitr"
>
    <div class="flex items-start gap-3">
        <div class="w-9 h-9 rounded-xl bg-[#5EBEE6]/15 flex items-center justify-center shrink-0">
            <i class="fa-solid fa-cookie-bite text-[#5EBEE6]"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-bold mb-1">เว็บไซต์นี้ใช้คุกกี้</p>
            <p class="text-xs text-gray-400 leading-relaxed mb-3">
                เราใช้คุกกี้เพื่อพัฒนาประสบการณ์การใช้งานเว็บไซต์ของคุณให้ดียิ่งขึ้น
                การใช้งานเว็บไซต์นี้ต่อถือว่าคุณยินยอมให้ใช้คุกกี้
                <a href="{{ route('privacy') }}" class="text-[#5EBEE6] hover:underline">อ่านนโยบายความเป็นส่วนตัว</a>
            </p>
            <div class="flex gap-2">
                <button
                    type="button"
                    @click="localStorage.setItem('cookie_consent_accepted', '1'); show = false"
                    class="px-5 py-2.5 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] text-white text-xs font-bold rounded-xl hover:shadow-lg hover:shadow-[#5EBEE6]/30 hover:-translate-y-0.5 transition-all active:scale-95"
                >
                    ยอมรับคุกกี้
                </button>
            </div>
        </div>
    </div>
</div>
@endif
