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
            <form action="/product/search" method="get">
                <div class="sidebar__search">
                    <input class="search-input"
                        type="text"
                        name="keyword"
                        value="{{ $keyword ?? request('keyword') }}"
                        placeholder="商品名で検索">
                    <button class="search-button" type="submit">検索</button>
                </div>
                <div class="sidebar__sort">
                    <p class="sort-title">価格順で表示</p>
                    <select class="sort-select" name="sort" id="sort">
                        <option value="" {{ ($sort ?? request('sort')) === '' ? 'selected' : '' }}>
                            価格で並び替え
                        </option>
                        <option value="price_desc" {{ ($sort ?? request('sort')) === 'price_desc' ? 'selected' : '' }}>
                            高い順に表示
                        </option>
                        <option value="price_asc" {{ ($sort ?? request('sort')) === 'price_asc' ? 'selected' : '' }}>
                            低い順に表示
                        </option>
                    </select>

                    @php
                        $currentSort = $sort ?? (string) request('sort', '');

                        $sortLabelMap = [
                            'price_desc' => '高い順に表示',
                            'price_asc'  => '低い順に表示',
                        ];

                        $sortLabel = $sortLabelMap[$currentSort] ?? null;

                        // sort と page だけ消して、keyword等は残す
                        $resetQuery = request()->except(['sort', 'page']);
                        $resetSortUrl = url()->current() . (count($resetQuery) ? ('?' . http_build_query($resetQuery)) : '');
                    @endphp

                    @if($sortLabel)
                        <div class="sort-tag" aria-label="並び替え条件">
                            <span class="sort-tag__text">{{ $sortLabel }}</span>
                            <a class="sort-tag__close" href="{{ $resetSortUrl }}" aria-label="並び替えをリセット">×</a>
                        </div>
                    @endif

                </div>
            </form>
        </aside>

        <section class="index__content">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-img">
                        @php
                            $img = ($product->image);
                        @endphp

                        @if (str_starts_with($img, 'products/'))
                        <a href="/products/detail/{{ $product->id }}">
                            <img class="img-storage" src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}（storage）">
                        </a>
                        @else
                        <a href="/products/detail/{{ $product->id }}">
                            <img class="img-public" src="{{ asset($img) }}" alt="{{ $product->name }}（public）">
                        </a>
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
