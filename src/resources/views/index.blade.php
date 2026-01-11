@extends('layouts.app')

@section('title','mogitate商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/paginate.css') }}">
@endsection

@section('content')
<div class="index">
    <div class="index__header">
        <h2 class="index__header-title">商品一覧</h2>
        <div class="index__header-action">
            <a class="header__link" href="/products/register">+ 商品を追加</a>
        </div>
    </div>

    <div class="index__main">
        <aside class="index__sidebar">
            <div class="sidebar__search">
                <input type="text">
                <button>検索</button>
            </div>
            <div class="sidebar__sort">
                <p>価格順で表示</p>
                <input type="text">
            </div>
        </aside>

        <section class="index__content">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-img">
                        @php
                            $img = ($product->image);
                        @endphp

                        @if (str_starts_with($img, 'products/'))
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}（storage）">
                        @else
                            <img src="{{ asset($img) }}" alt="{{ $product->name }}（public）">
                        @endif
                    </div>

                    <div class="product-meta">
                        <p>{{ $product->name }}</p>
                        <p>¥{{ $product->price }}</p>
                    </div>
                </div>
            @endforeach

            <div class="paginate">
                {{ $products->links('vendor.pagination.paginate') }}
            </div>
        </section>
    </div>
</div>
@endsection
