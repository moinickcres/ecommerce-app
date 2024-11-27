<div>
    <h3>Products</h3>
    <ul>
        @foreach ($products as $product)
            <li>
                <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                - ${{ $product->price }}
            </li>
        @endforeach
    </ul>
</div>



<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
