@extends('layouts.app')

@section('title','mogitate商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<form class="form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div class="detail">
        <div class="detail__content">
            <div class="breadcrumb">
                <a href="/products">商品一覧</a>
                <span>>{{ $product->name }}</span>
            </div>
            <div class="detail__card">
                <div class="detail__card--img">
                    @php
                        $img = ($product->image);
                    @endphp

                    @if (str_starts_with($img, 'products/'))
                        <img class="img-storage" id="imagePreview" src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}（storage）">
                    @else
                        <img class="img-public" id="imagePreview" src="{{ asset($img) }}" alt="{{ $product->name }}（public）">
                    @endif

                    <input type="file" name="image" id="imageInput" hidden accept="image/png,image/jpeg">
                    <button class="store-content__image-button" type="button" id="imagePickBtn">
                        ファイルを選択
                    </button>
                    <div class="product__error">
                            @error('image')
                            {{ $message }}
                            @enderror
                    </div>
                </div>
                <div class="detail__card--meta">
                    <div class="meta__item">
                        <p class="meta__item-title">商品名</p>
                        <input class="meta__item-input" type="text" name="name" value="{{ $product->name }}">
                        <div class="product__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="meta__item">
                        <p class="meta__item-title">値段</p>
                        <input class="meta__item-input" type="text" name="price" value="{{ $product->price }}">
                        <div class="product__error">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="meta__item">
                        <p class="meta__item-title">季節</p>
                        @php $selected = old('season_ids', $product->seasons->pluck('id')->all()); @endphp

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
                </div>
            </div>
            <div class="detail__textarea">
                <p class="detail-title">商品説明</p>
                <textarea class="textarea" name="description">{{ $product->description }}</textarea>
                <div class="product__error">
                            @error('description')
                            {{ $message }}
                            @enderror
                </div>
            </div>
            <div class="detail__button">
                <div class="grid--center">
                    <a class="button--back" href="/products">戻る</a>
                    <button class="button--update" type="submit">変更を保存</button>
                </div>
                <div class="grid--right">
                    <button  class="button--delete" type="submit" form="deleteForm">
                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                        <path d="M9 3h6l1 2h5v2H3V5h5l1-2zm1 6h2v10h-2V9zm4 0h2v10h-2V9zM6 9h2v10H6V9zm2 12h8a2 2 0 0 0 2-2V7H6v12a2 2 0 0 0 2 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form id="deleteForm" action="/products/{{ $product->id }}/delete" method="post">
    @method('delete')
    @csrf
</form>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('imagePickBtn');
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');

    btn.addEventListener('click', () => input.click());

    input.addEventListener('change', () => {
        const file = input.files && input.files[0];
        if (!file) return; // キャンセルなら何もしない（元画像は残す）

        // png/jpegだけに絞る（必要なら）
        if (file.type !== 'image/png' && file.type !== 'image/jpeg') {
        input.value = ''; // 選択をリセット
        return;
        }

        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.onload = () => URL.revokeObjectURL(url);
    });
});
</script>


@endsection