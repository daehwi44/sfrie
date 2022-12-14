<x-app-layout>
  <x-slot name="header">
    <x-comindex-navi></x-comindex-navi>
    <div class="bg-white">
      <h2 class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
        新規作成
      </h2>
    </div>
    {{--エラーメッセージ--}}
    <x-validation-errors class="mb-4 ml-10" :errors="$errors" />
    {{--投稿完了メッセージ--}}
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <form method="post" action="{{route('community.store')}}" enctype="multipart/form-data">
        @csrf
        <!-- コミュニティ名 -->
        <div class="md:flex items-center">
          <div class="w-full flex flex-col">
            <label for="body" class="font-semibold leading-none">コミュニティ名</label>
            <input type="text" name="name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="name" value="{{old('name')}}" placeholder="Enter Title">
          </div>
        </div>

        <!-- イメージ画像 -->
        <div class="w-full flex flex-col">
          <label for="image" class="font-semibold leading-none mt-4">イメージ画像 （1MBまで）</label>
          <div>
            <input id="image" type="file" name="image">
          </div>
        </div>

        <!-- area -->
        <div class="mt-4">
          <x-label for="m_area_id" :value="__('都道府県')" />
          <select name="m_area_id" required>
            @foreach($areas as $area)
            <option value="{{ $area->id }}" @if (isset($user->m_area_id) && ($user->m_area_id === $area->id)) selected @endif>{{ $area->area }}</option>
            @endforeach
          </select>
        </div>

        <!-- category -->
        <div class="mt-4">
          <x-label for="m_category_id" :value="__('カテゴリー')" />
          <select name="m_category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if (isset($user->m_category_id) && ($user->m_category_id === $category->id)) selected @endif>{{ $category->category}}</option>
            @endforeach
          </select>
        </div>

        <!-- 学習内容 -->
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
            <label for="body" class="font-semibold leading-none mt-4">学習内容</label>
            <input type="text" name="content" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="content" value="{{old('content')}}" placeholder="Enter Title">
          </div>
        </div>

        <!-- コミュニティ詳細 -->
        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="about" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="about" cols="30" rows="10">{{old('about')}}</textarea>
        </div>

        <x-button class="mt-4">
          送信する
        </x-button>

      </form>
    </div>
  </div>
</x-app-layout>