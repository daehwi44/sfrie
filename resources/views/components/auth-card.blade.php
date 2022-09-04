<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 login bg-cover">
    <div class="pt-3">
        {{ $logo }}
    </div>

    <div class="text-gray w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-50 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>


{{-- ログインページの背景画像設定 --}}
<style>
    .login {
        /*
    background: url(bg/friends.jpg);
  */
        background: url(bg/friends.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>