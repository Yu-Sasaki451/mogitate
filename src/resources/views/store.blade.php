@extends('layouts.app')

@section('title','mogitate商品登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection

@section('content')


<form class="form"
        action="/products/register"
        method="post"
        enctype="multipart/form-data">
    @csrf

    <div class="store">
        <div class="store-content">
            <div class="store-content__items">

                <div class="store-content__item">
                    <div class="store-content__header">
                        <h2 class="header-logo">商品登録</h2>
                    </div>
                </div>

                <div class="store-content__item">
                    <p class="store-content__item-header">商品名　<span class="item-header__span">必須</span></p>
                    <input class="store-content__item-input" type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
                    <div class="product__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                    </div>
                </div>

                <div class="store-content__item">
                    <p class="store-content__item-header">値段　<span class="item-header__span">必須</span></p>
                    <input class="store-content__item-input" type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
                    <div class="product__error">
                            @error('price')
                            {{ $message }}
                            @enderror
                    </div>
                </div>

                <div class="store-content__item">
                    <p class="store-content__item-header">商品画像　<span class="item-header__span">必須</span></p>

                    <div class="image-field__preview">
                        <img class="store-content__image-preview" id="imagePreview" alt="プレビュー" hidden>
                    </div>

                    <div class="image-field__control">
                        <button class="store-content__image-button" type="button" id="imagePickBtn">
                            ファイルを選択
                        </button>

                        <span class="store-content__image-filename" id="imageFileName"></span>

                        <input
                            type="file"
                            name="image"
                            id="imageInput"
                            accept="image/*"
                            hidden
                        >
                    </div>
                    <div class="product__error">
                            @error('image')
                            {{ $message }}
                            @enderror
                    </div>
                </div>

                <div class="store-content__item">
                    <p class="store-content__item-header">季節　
                        <span class="item-header__span">必須</span>
                        <span class="item-header__span-multi">　複数選択可</span>
                    </p>

                    @php $selected = old('season_ids', []); @endphp

                    <div class="season">
                        @foreach($seasons as $season)
                            <label class="season__option">
                                <input
                                    type="checkbox"
                                    name="season_ids[]"
                                    value="{{ $season->id }}"
                                    {{ in_array($season->id, $selected) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="product__error">
                            @error('season_ids')
                            {{ $message }}
                            @enderror
                    </div>
                </div>

                <div class="store-content__item">
                    <p class="store-content__item-header">商品説明　<span class="item-header__span">必須</span></p>
                    <textarea class="store-content__item-textarea" name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                    <div class="product__error">
                            @error('description')
                            {{ $message }}
                            @enderror
                    </div>
                </div>

                <div class="store-content__item">
                    <div class="store-content__item-button">
                        <a class="button--back" href="/products">戻る</a>
                        <button class="button--store" type="submit">登録</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('imagePickBtn');
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const fileName = document.getElementById('imageFileName');

    btn.addEventListener('click', () => input.click());

    input.addEventListener('change', () => {
        const file = input.files && input.files[0];

        if (!file) {
            fileName.textContent = '';
            preview.hidden = true;
            preview.src = '';
            return;
        }

        fileName.textContent = file.name;

        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.hidden = false;

        preview.onload = () => URL.revokeObjectURL(url);
    });
});
</script>
@endsection
