<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>ID</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>
    </thead>

    <tbody>

    @foreach($items as $item)

    <tr>
        <td>
            <p><strong>{{ $item->name }}</strong></p>
            <p>{{ ($item->options->has('size') ? $item->options->size : '') }}</p>
        </td>
        <td><input type="text" value="{{ $item->qty }}"></td>
        <td>{{ $item->rowId }}</td>
        <td>${{ $item->price }}</td>
        <td>${{ $item->total }}</td>
    </tr>

    @endforeach

    </tbody>

    <tfoot>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td>Subtotal</td>
        <td>{{ $subtotal }}</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td>Total</td>
        <td>{{ $subtotal }}</td>
    </tr>
    </tfoot>
</table>